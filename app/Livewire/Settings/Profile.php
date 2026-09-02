<?php

namespace App\Livewire\Settings;

use App\Models\User;
use App\Models\user_information;
use App\Models\dti_id;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    // Basic Info
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $bio = '';
    public $profileImage;
    public $coverPhoto;

    // Contact Info
    public ?string $phone_number = null;
    public ?string $address = null;
    public ?string $gender = null;
    public ?string $birthday = null;
    public ?string $civil_status = null;

    // Work Info
    public ?string $career = null;
    public ?string $level_career = null;
    public ?string $years_in_dti = null;
    public ?string $nature_of_work = null;
    public ?string $function = null;

    // Education
    public ?string $educational_attachment_type = null;
    public ?string $educational_attachment = null;

    // Health Info
    public ?string $height = null;
    public ?string $weight = null;
    public ?string $activity_level = null;
    public ?string $health_goals = null;
    public ?string $dietary_preferences = null;

    // Staff Info
    public ?string $staff_id = null;
    public ?string $office = null;
    public ?string $department = null;
    public ?string $position = null;

    // Edit modes
    public bool $editingBasicInfo = false;
    public bool $editingContactInfo = false;
    public bool $editingWorkInfo = false;
    public bool $editingEducation = false;
    public bool $editingHealth = false;
    public bool $editingStaff = false;

    // Mobile image save state
    public bool $hasPendingImages = false;

    // Personal Information
    public ?string $phone_number = null;
    public ?string $gender = null;
    public ?string $birthday = null;
    public ?string $address = null;
    public ?string $civil_status = null;

    // Health Information
    public ?string $height = null;
    public ?string $weight = null;
    public ?string $activity_level = null;
    public ?string $health_goals = null;
    public ?string $dietary_preferences = null;

    // Career Information
    public ?string $staff_id = null;
    public ?string $office = null;
    public ?string $position = null;
    public ?string $department = null;
    public ?string $nature_of_work = null;
    public ?string $level_career = null;
    public ?string $years_in_dti = null;

    public function updatedBirthday($value)
    {
        // Normalize empty string to null for date validation
        if ($value === '' || $value === null) {
            $this->birthday = null;
        }
    }

    public function mount(): void
    {
        $user = Auth::user();
        $userInfo = $user->information;
        $staffInfo = $user->staff;

        // Basic Info
        $this->firstname = $user->firstname ?? '';
        $this->lastname = $user->lastname ?? '';
        $this->email = $user->email ?? '';
        $this->bio = $user->bio ?? '';
        $this->profileImage = $user->profileimage;
        $this->coverPhoto = $user->cover_photo;

        // Contact Info
        $this->phone_number = $userInfo->phone_number ?? null;
        $this->address = $userInfo->address ?? null;
        $this->gender = $userInfo->gender ?? null;
        $this->birthday = $userInfo->birthday ? $userInfo->birthday->format('Y-m-d') : null;
        $this->civil_status = $userInfo->civil_status ?? null;

        // Work Info
        $this->career = $userInfo->career ?? null;
        $this->level_career = $userInfo->level_career ?? null;
        $this->years_in_dti = $userInfo->years_in_dti ?? null;
        $this->nature_of_work = $userInfo->nature_of_work ?? null;
        $this->function = $userInfo->function ?? null;

        // Education
        $this->educational_attachment_type = $userInfo->educational_attachment_type ?? null;
        $this->educational_attachment = $userInfo->educational_attachment ?? null;

        // Health Info
        $this->height = $userInfo->height ?? null;
        $this->weight = $userInfo->weight ?? null;
        $this->activity_level = $userInfo->activity_level ?? null;
        $this->health_goals = $userInfo->health_goals ?? null;
        $this->dietary_preferences = $userInfo->dietary_preferences ?? null;

        // Staff Info
        if ($staffInfo) {
            $this->staff_id = $staffInfo->staff_id ?? null;
            $this->office = $staffInfo->office ?? null;
            $this->department = $staffInfo->department ?? null;
            $this->position = $staffInfo->position ?? null;
        }
    }

    public function updatedProfileImage()
    {
        // Check if we're on mobile and show save popup
        $this->checkPendingImages();
    }

    public function updatedCoverPhoto()
    {
        // Check if we're on mobile and show save popup
        $this->checkPendingImages();
    }

    protected function checkPendingImages()
    {
        $hasNewProfileImage = $this->profileImage && is_object($this->profileImage) && method_exists($this->profileImage, 'temporaryUrl');
        $hasNewCoverPhoto = $this->coverPhoto && is_object($this->coverPhoto) && method_exists($this->coverPhoto, 'temporaryUrl');

        $this->hasPendingImages = $hasNewProfileImage || $hasNewCoverPhoto;
    }

    public function saveProfileImage(): void
    {
        $user = Auth::user();

        if ($this->profileImage && is_object($this->profileImage) && method_exists($this->profileImage, 'store')) {
            $user->profileimage = $this->profileImage->store('profile', 'public');
            $user->save();
            $this->checkPendingImages();
            $this->dispatch('profile-updated', name: $user->firstname);
        }
    }

    public function saveCoverPhoto(): void
    {
        $user = Auth::user();

        if ($this->coverPhoto && is_object($this->coverPhoto) && method_exists($this->coverPhoto, 'store')) {
            $user->cover_photo = $this->coverPhoto->store('covers', 'public');
            $user->save();
            $this->checkPendingImages();
            $this->dispatch('profile-updated', name: $user->firstname);
        }
    }

    public function saveImagesOnly(): void
    {
        $user = Auth::user();
        $updated = false;

        // Handle profile image upload
        if ($this->profileImage && is_object($this->profileImage) && method_exists($this->profileImage, 'store')) {
            $user->profileimage = $this->profileImage->store('profile', 'public');
            $updated = true;
        }

        // Handle cover photo upload
        if ($this->coverPhoto && is_object($this->coverPhoto) && method_exists($this->coverPhoto, 'store')) {
            $user->cover_photo = $this->coverPhoto->store('covers', 'public');
            $updated = true;
        }

        if ($updated) {
            $user->save();
            $this->hasPendingImages = false;
            $this->dispatch('profile-updated', name: $user->firstname);
        }
    }

    public function cancelProfileImage(): void
    {
        $user = Auth::user();
        $this->profileImage = $user->profileimage;
        $this->checkPendingImages();
    }

    public function cancelCoverPhoto(): void
    {
        $user = Auth::user();
        $this->coverPhoto = $user->cover_photo;
        $this->checkPendingImages();
    }

    public function cancelImageUpload(): void
    {
        $user = Auth::user();

        // Reset to original images
        if ($this->profileImage && is_object($this->profileImage)) {
            $this->profileImage = $user->profileimage;
        }

        if ($this->coverPhoto && is_object($this->coverPhoto)) {
            $this->coverPhoto = $user->cover_photo;
        }

        $this->hasPendingImages = false;
    }

    public function updateBasicInfo(): void
    {
        $user = Auth::user();

        // Normalize empty birthday string to null
        if ($this->birthday === '') {
            $this->birthday = null;
        }

        $validated = $this->validate([
            'firstname'    => ['nullable', 'string', 'max:255'],
            'lastname'     => ['nullable', 'string', 'max:255'],
            'bio'          => ['nullable', 'string', 'max:500'],
            'profileImage' => ['nullable', 'image', 'max:2048'],
            'coverPhoto'   => ['nullable', 'image', 'max:5120'],
            'email'        => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
            // Personal Information
            'phone_number' => ['nullable', 'string'],
            'gender' => ['nullable', 'string'],
            'birthday' => ['nullable', 'date'],
            'address' => ['nullable', 'string'],
            'civil_status' => ['nullable', 'string'],
            // Health Information
            'height' => ['nullable', 'string'],
            'weight' => ['nullable', 'string'],
            'activity_level' => ['nullable', 'string'],
            'health_goals' => ['nullable', 'string'],
            'dietary_preferences' => ['nullable', 'string'],
            // Career Information
            'staff_id' => ['nullable', 'string', 'max:255'],
            'office' => ['nullable', 'string'],
            'position' => ['nullable', 'string'],
            'department' => ['nullable', 'string'],
            'nature_of_work' => ['nullable', 'string'],
            'level_career' => ['nullable', 'string'],
            'years_in_dti' => ['nullable', 'string'],
        ]);

        // Handle image uploads
        if ($this->profileImage) {
            if (is_object($this->profileImage) && method_exists($this->profileImage, 'store')) {
                $validated['profileimage'] = $this->profileImage->store('profile', 'public');
            }
            // If it's already a string path, keep it
        }

        if ($this->coverPhoto) {
            if (is_object($this->coverPhoto) && method_exists($this->coverPhoto, 'store')) {
                $validated['cover_photo'] = $this->coverPhoto->store('covers', 'public');
            }
            // If it's already a string path, keep it
        }

        // Update basic user info
        $user->fill($validated);
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();
        $this->editingBasicInfo = false;
        $this->hasPendingImages = false;
        $this->dispatch('profile-updated', name: $user->firstname);
    }

    public function updateContactInfo(): void
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new user_information(['user_id' => $user->id]);

        $validated = $this->validate([
            'phone_number' => ['nullable', 'string', 'max:20'],
            'address'      => ['nullable', 'string', 'max:500'],
            'gender'       => ['nullable', 'string', 'in:Male,Female,Other'],
            'birthday'     => ['nullable', 'date'],
            'civil_status' => ['nullable', 'string'],
        ]);

        $userInfo->fill($validated);
        $userInfo->save();

        $this->editingContactInfo = false;
        $this->dispatch('contact-info-updated');
    }

    public function updateWorkInfo(): void
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new user_information(['user_id' => $user->id]);

        $validated = $this->validate([
            'career'        => ['nullable', 'string', 'max:255'],
            'level_career'  => ['nullable', 'string', 'max:255'],
            'years_in_dti'  => ['nullable', 'string', 'max:255'],
            'nature_of_work' => ['nullable', 'string', 'max:255'],
            'function'     => ['nullable', 'string', 'max:255'],
        ]);

        $userInfo->fill($validated);
        $userInfo->save();

        $this->editingWorkInfo = false;
        $this->dispatch('work-info-updated');
    }

    public function updateEducation(): void
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new user_information(['user_id' => $user->id]);

        $validated = $this->validate([
            'educational_attachment_type' => ['nullable', 'string', 'max:255'],
            'educational_attachment'      => ['nullable', 'string', 'max:255'],
        ]);

        $userInfo->fill($validated);
        $userInfo->save();

        $this->editingEducation = false;
        $this->dispatch('education-updated');
    }

    public function updateHealthInfo(): void
    {
        $user = Auth::user();
        $userInfo = $user->information ?? new user_information(['user_id' => $user->id]);

        $validated = $this->validate([
            'height'             => ['nullable', 'string', 'max:10'],
            'weight'             => ['nullable', 'string', 'max:10'],
            'activity_level'     => ['nullable', 'string', 'max:255'],
            'health_goals'       => ['nullable', 'string', 'max:500'],
            'dietary_preferences' => ['nullable', 'string', 'max:500'],
        ]);

        $userInfo->fill($validated);
        $userInfo->save();

        $this->editingHealth = false;
        $this->dispatch('health-info-updated');
    }

    public function updateStaffInfo(): void
    {
        $user = Auth::user();
        $staffInfo = $user->staff;

        $validated = $this->validate([
            'staff_id'   => ['nullable', 'string', 'max:255'],
            'office'     => ['nullable', 'string', 'max:255'],
            'department' => ['nullable', 'string', 'max:255'],
            'position'   => ['nullable', 'string', 'max:255'],
        ]);

        if ($staffInfo) {
            $staffInfo->update($validated);
        } else {
            $validated['user_id'] = $user->id;
            $user->staff()->create($validated);
        }

        $this->editingStaff = false;
        $this->dispatch('staff-info-updated');
    }

    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }
}
