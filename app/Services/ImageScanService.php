<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;
use Exception;

class ImageScanService
{
    /**
     * Whether to enable strict scanning (can be disabled via env for troubleshooting)
     */
    private bool $strictMode;

    public function __construct()
    {
        $this->strictMode = env('IMAGE_SCANNING_STRICT', true);
    }

    /**
     * Allowed image MIME types
     */
    private const ALLOWED_MIME_TYPES = [
        'image/jpeg',
        'image/jpg',
        'image/png',
        'image/gif',
        'image/webp',
    ];

    /**
     * Allowed image file extensions
     */
    private const ALLOWED_EXTENSIONS = [
        'jpg',
        'jpeg',
        'png',
        'gif',
        'webp',
    ];

    /**
     * Maximum file size in bytes (8MB)
     */
    private const MAX_FILE_SIZE = 8388608; // 8MB

    /**
     * Scan and validate an uploaded image
     *
     * @param UploadedFile $file
     * @return array ['success' => bool, 'message' => string, 'data' => array]
     */
    public function scanImage(UploadedFile $file): array
    {
        try {
            // Step 1: Validate file size
            $sizeValidation = $this->validateFileSize($file);
            if (!$sizeValidation['success']) {
                return $sizeValidation;
            }

            // Step 2: Validate file extension
            $extensionValidation = $this->validateFileExtension($file);
            if (!$extensionValidation['success']) {
                return $extensionValidation;
            }

            // Step 3: Validate MIME type
            $mimeValidation = $this->validateMimeType($file);
            if (!$mimeValidation['success']) {
                return $mimeValidation;
            }

            // Step 4: Validate image integrity
            $integrityValidation = $this->validateImageIntegrity($file);
            if (!$integrityValidation['success']) {
                return $integrityValidation;
            }

            // Step 5: Check for malicious content patterns (skip in non-strict mode for troubleshooting)
            if ($this->strictMode) {
                $securityValidation = $this->scanForSecurityThreats($file);
                if (!$securityValidation['success']) {
                    return $securityValidation;
                }
            }

            // Step 6: Get image metadata
            $metadata = $this->getImageMetadata($file);

            return [
                'success' => true,
                'message' => 'Image scanned successfully',
                'data' => [
                    'filename' => $file->getClientOriginalName(),
                    'size' => $file->getSize(),
                    'mime_type' => $file->getMimeType(),
                    'extension' => $file->getClientOriginalExtension(),
                    'metadata' => $metadata,
                ],
            ];
        } catch (Exception $e) {
            Log::error('Image scanning failed', [
                'error' => $e->getMessage(),
                'file' => $file->getClientOriginalName(),
            ]);

            return [
                'success' => false,
                'message' => 'Image scanning failed: ' . $e->getMessage(),
                'data' => [],
            ];
        }
    }

    /**
     * Validate file size
     */
    private function validateFileSize(UploadedFile $file): array
    {
        $fileSize = $file->getSize();

        if ($fileSize > self::MAX_FILE_SIZE) {
            return [
                'success' => false,
                'message' => 'Image size exceeds maximum allowed size of ' . $this->formatBytes(self::MAX_FILE_SIZE),
                'data' => ['size' => $fileSize],
            ];
        }

        if ($fileSize === 0) {
            return [
                'success' => false,
                'message' => 'Image file is empty',
                'data' => [],
            ];
        }

        return ['success' => true, 'message' => 'File size is valid', 'data' => ['size' => $fileSize]];
    }

    /**
     * Validate file extension
     */
    private function validateFileExtension(UploadedFile $file): array
    {
        $extension = strtolower($file->getClientOriginalExtension());

        if (!in_array($extension, self::ALLOWED_EXTENSIONS)) {
            return [
                'success' => false,
                'message' => 'Invalid file extension. Allowed extensions: ' . implode(', ', self::ALLOWED_EXTENSIONS),
                'data' => ['extension' => $extension],
            ];
        }

        return ['success' => true, 'message' => 'File extension is valid', 'data' => ['extension' => $extension]];
    }

    /**
     * Validate MIME type
     */
    private function validateMimeType(UploadedFile $file): array
    {
        $mimeType = $file->getMimeType();

        if (!in_array($mimeType, self::ALLOWED_MIME_TYPES)) {
            return [
                'success' => false,
                'message' => 'Invalid file type. Allowed types: ' . implode(', ', self::ALLOWED_MIME_TYPES),
                'data' => ['mime_type' => $mimeType],
            ];
        }

        // Double-check: verify the actual file content matches the extension
        $extension = strtolower($file->getClientOriginalExtension());
        $expectedMime = $this->getExpectedMimeType($extension);

        if ($expectedMime && $mimeType !== $expectedMime) {
            // Allow some flexibility (e.g., jpg vs jpeg)
            if (!($extension === 'jpg' && $mimeType === 'image/jpeg')) {
                return [
                    'success' => false,
                    'message' => 'File type mismatch. File extension does not match file content.',
                    'data' => ['mime_type' => $mimeType, 'extension' => $extension],
                ];
            }
        }

        return ['success' => true, 'message' => 'MIME type is valid', 'data' => ['mime_type' => $mimeType]];
    }

    /**
     * Validate image integrity by attempting to read it
     */
    private function validateImageIntegrity(UploadedFile $file): array
    {
        try {
            // Try multiple methods to get file path (for Livewire and standard uploads)
            $path = $file->getRealPath();
            
            // Fallback for Livewire temporary files
            if (!$path || !file_exists($path)) {
                $path = $file->getPathname();
            }
            
            // Another fallback - try temporary file path
            if (!$path || !file_exists($path)) {
                $path = $file->path();
            }
            
            if (!$path || !file_exists($path)) {
                // If we still can't access the file, try reading the content directly
                try {
                    $content = file_get_contents($file->getRealPath() ?: $file->path());
                    if ($content === false) {
                        return [
                            'success' => false,
                            'message' => 'Image file cannot be accessed',
                            'data' => [],
                        ];
                    }
                    // Create temporary file to validate
                    $tempPath = sys_get_temp_dir() . '/' . uniqid('img_scan_') . '.' . $file->getClientOriginalExtension();
                    file_put_contents($tempPath, $content);
                    $path = $tempPath;
                    $isTemp = true;
                } catch (Exception $e) {
                    return [
                        'success' => false,
                        'message' => 'Image file cannot be accessed: ' . $e->getMessage(),
                        'data' => [],
                    ];
                }
            } else {
                $isTemp = false;
            }

            // Try to get image info
            $imageInfo = @getimagesize($path);

            // Clean up temp file if we created one
            if (isset($isTemp) && $isTemp && file_exists($path)) {
                @unlink($path);
            }

            if ($imageInfo === false) {
                return [
                    'success' => false,
                    'message' => 'Invalid or corrupted image file',
                    'data' => [],
                ];
            }

            // Verify it's actually an image
            if (!isset($imageInfo[2]) || !in_array($imageInfo[2], [IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF, IMAGETYPE_WEBP])) {
                return [
                    'success' => false,
                    'message' => 'File is not a valid image format',
                    'data' => ['detected_type' => $imageInfo[2] ?? 'unknown'],
                ];
            }

            return [
                'success' => true,
                'message' => 'Image integrity validated',
                'data' => [
                    'width' => $imageInfo[0] ?? null,
                    'height' => $imageInfo[1] ?? null,
                    'type' => $imageInfo[2] ?? null,
                ],
            ];
        } catch (Exception $e) {
            Log::error('Image integrity validation failed', [
                'error' => $e->getMessage(),
                'file' => $file->getClientOriginalName(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return [
                'success' => false,
                'message' => 'Failed to validate image integrity: ' . $e->getMessage(),
                'data' => [],
            ];
        }
    }

    /**
     * Scan for security threats
     */
    private function scanForSecurityThreats(UploadedFile $file): array
    {
        try {
            $isDirectRead = false;
            $header = '';
            
            // Try multiple methods to get file path
            $path = $file->getRealPath();
            
            if (!$path || !file_exists($path)) {
                $path = $file->getPathname();
            }
            
            if (!$path || !file_exists($path)) {
                $path = $file->path();
            }
            
            // If still can't access, try reading content directly
            if (!$path || !file_exists($path)) {
                try {
                    $content = file_get_contents($file->getRealPath() ?: $file->path());
                    if ($content === false || strlen($content) < 12) {
                        return [
                            'success' => false,
                            'message' => 'Cannot access file for security scanning',
                            'data' => [],
                        ];
                    }
                    $header = substr($content, 0, 12);
                    $isDirectRead = true;
                } catch (Exception $e) {
                    return [
                        'success' => false,
                        'message' => 'Cannot access file for security scanning: ' . $e->getMessage(),
                        'data' => [],
                    ];
                }
            } else {
                // Read first few bytes to check for magic numbers
                $handle = @fopen($path, 'rb');
                if (!$handle) {
                    return [
                        'success' => false,
                        'message' => 'Cannot read file for security scanning',
                        'data' => [],
                    ];
                }

                $header = fread($handle, 12);
                fclose($handle);
            }

            // Check for image magic numbers
            $magicNumbers = [
                'JPEG' => ["\xFF\xD8\xFF"],
                'PNG' => ["\x89\x50\x4E\x47\x0D\x0A\x1A\x0A"],
                'GIF' => ["\x47\x49\x46\x38\x37\x61", "\x47\x49\x46\x38\x39\x61"],
                'WEBP' => ["\x52\x49\x46\x46"], // RIFF header (WEBP starts with RIFF)
            ];

            $isValidImage = false;
            foreach ($magicNumbers as $format => $magics) {
                foreach ($magics as $magic) {
                    if (substr($header, 0, strlen($magic)) === $magic) {
                        $isValidImage = true;
                        break 2;
                    }
                }
            }

            // For WEBP, need to check further
            if (substr($header, 0, 4) === "\x52\x49\x46\x46") {
                // Check if it contains WEBP signature
                if ($isDirectRead) {
                    $fullContent = file_get_contents($file->getRealPath() ?: $file->path());
                    $webpHeader = substr($fullContent, 0, 20);
                } else {
                    $webpHeader = @file_get_contents($path, false, null, 0, 20);
                }
                if ($webpHeader && strpos($webpHeader, 'WEBP') !== false) {
                    $isValidImage = true;
                }
            }

            if (!$isValidImage) {
                return [
                    'success' => false,
                    'message' => 'File does not contain valid image data. Possible security threat detected.',
                    'data' => [],
                ];
            }

            // Check for suspicious file names (basic check)
            $filename = $file->getClientOriginalName();
            $suspiciousPatterns = [
                '/\.(php|exe|sh|bat|cmd|scr|vbs|js|jar|com|pif)$/i',
                '/\.(php\d+|phtml)$/i',
            ];

            foreach ($suspiciousPatterns as $pattern) {
                if (preg_match($pattern, $filename)) {
                    return [
                        'success' => false,
                        'message' => 'Suspicious file name detected',
                        'data' => ['filename' => $filename],
                    ];
                }
            }

            return [
                'success' => true,
                'message' => 'Security scan passed',
                'data' => [],
            ];
        } catch (Exception $e) {
            Log::warning('Security scan encountered an error', [
                'error' => $e->getMessage(),
                'file' => $file->getClientOriginalName(),
            ]);

            // Don't fail on scanning errors, but log them
            return [
                'success' => true,
                'message' => 'Security scan completed with warnings',
                'data' => ['warning' => $e->getMessage()],
            ];
        }
    }

    /**
     * Get image metadata
     */
    private function getImageMetadata(UploadedFile $file): array
    {
        try {
            $path = $file->getRealPath();
            $imageInfo = @getimagesize($path);

            if ($imageInfo === false) {
                return [];
            }

            return [
                'width' => $imageInfo[0] ?? null,
                'height' => $imageInfo[1] ?? null,
                'type' => $imageInfo[2] ?? null,
                'mime' => $imageInfo['mime'] ?? null,
                'bits' => $imageInfo['bits'] ?? null,
                'channels' => $imageInfo['channels'] ?? null,
            ];
        } catch (Exception $e) {
            return [];
        }
    }

    /**
     * Get expected MIME type for extension
     */
    private function getExpectedMimeType(string $extension): ?string
    {
        $mimeMap = [
            'jpg' => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'png' => 'image/png',
            'gif' => 'image/gif',
            'webp' => 'image/webp',
        ];

        return $mimeMap[strtolower($extension)] ?? null;
    }

    /**
     * Format bytes to human readable format
     */
    private function formatBytes(int $bytes, int $precision = 2): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, $precision) . ' ' . $units[$i];
    }
}

