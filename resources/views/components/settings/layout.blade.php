<section class="w-full">
    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">

        <!-- Mini Profile Card -->
        <div class="mb-8 bg-white dark:bg-gray-800 rounded-3xl border border-gray-200/60 dark:border-gray-700/60 p-7 lg:p-9 shadow-xl hover:shadow-2xl transition-all duration-300 backdrop-blur-sm bg-white/95 dark:bg-gray-800/95">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 shadow-lg">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 dark:text-gray-100">Account Overview</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Personal Details -->
                <div class="space-y-3">
                    <h4 class="text-sm font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Personal Details</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Name:</span>
                            <span class="text-gray-800 dark:text-gray-200 font-semibold">{{ $firstname }} {{ $lastname }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Email:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $email }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Phone:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $phone_number ?? 'Not set' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Gender:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $gender ?? 'Not set' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Birthday:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $birthday ? \Carbon\Carbon::parse($birthday)->format('M d, Y') : 'Not set' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Address:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $address ?? 'Not set' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Civil Status:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $civil_status ?? 'Not set' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Career Information -->
                <div class="space-y-3">
                    <h4 class="text-sm font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Career Information</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">DTI ID:</span>
                            <span class="text-gray-800 dark:text-gray-200 font-semibold">{{ $staff_id ?? 'Not set' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Office:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $office ?? 'Not set' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Position:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $position ?? 'Not set' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Department:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $department ?? 'Not set' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Nature of Work:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $nature_of_work ?? 'Not set' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Level:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $level_career ?? 'Not set' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Years in DTI:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $years_in_dti ?? 'Not set' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Health Information -->
                <div class="space-y-3">
                    <h4 class="text-sm font-bold text-gray-600 dark:text-gray-400 uppercase tracking-wide">Health Information</h4>
                    <div class="space-y-2 text-sm">
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Height:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $height ? $height . ' cm' : 'Not set' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Weight:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $weight ? $weight . ' kg' : 'Not set' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Activity Level:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $activity_level ?? 'Not set' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Health Goals:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $health_goals ?? 'Not set' }}</span>
                        </div>
                        <div class="flex items-start gap-2">
                            <span class="text-gray-500 dark:text-gray-400 font-medium min-w-[100px]">Dietary Pref:</span>
                            <span class="text-gray-800 dark:text-gray-200">{{ $dietary_preferences ?? 'Not set' }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <form wire:submit="updateProfileInformation" class="w-full">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

                <!-- ============================================= -->
                <!-- MODERNIZED Profile Picture Card                -->
                <!-- ============================================= -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-200/60 dark:border-gray-700/60 p-7 lg:p-9 shadow-xl hover:shadow-2xl transition-all duration-300 backdrop-blur-sm bg-white/95 dark:bg-gray-800/95">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="p-2 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Profile Picture</h3>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-7 font-medium">PNG or JPG, up to 2MB. Square images look best.</p>

                    @php
                        $hasCustomImage = auth()->user()->profileimage;
                        $currentImage = $hasCustomImage ? asset('storage/' . auth()->user()->profileimage) : asset('images/default.png');
                        $previewSrc = (is_object($profileImage) && method_exists($profileImage, 'temporaryUrl'))
                            ? $profileImage->temporaryUrl()
                            : $currentImage;
                    @endphp

                    <div class="flex flex-col items-center gap-5">
                        <!-- Avatar with in-place edit affordance -->
                        <label for="profileImageInput" class="relative group cursor-pointer block">
                            <!-- glow ring -->
                            <div class="absolute -inset-1.5 rounded-full bg-gradient-to-br from-primary-400 to-primary-600 opacity-0 group-hover:opacity-40 blur-lg transition-opacity duration-300"></div>

                            <div class="relative w-32 h-32 rounded-full overflow-hidden border-4 border-gray-200 dark:border-gray-700 shadow-2xl transition-all duration-300 group-hover:border-primary-400 dark:group-hover:border-primary-500">
                                <img
                                    wire:loading.class="opacity-40 scale-105"
                                    wire:target="profileImage"
                                    src="{{ $previewSrc }}"
                                    alt="Profile Preview"
                                    class="w-full h-full object-cover transition-all duration-300">

                                <!-- hover overlay -->
                                <div class="absolute inset-0 flex flex-col items-center justify-center gap-1 bg-gray-900/0 group-hover:bg-gray-900/55 transition-all duration-300 opacity-0 group-hover:opacity-100">
                                    <svg class="w-6 h-6 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z" />
                                        <circle cx="12" cy="13" r="4" />
                                    </svg>
                                    <span class="text-[11px] font-semibold text-white">Change</span>
                                </div>

                                <!-- uploading spinner -->
                                <div wire:loading wire:target="profileImage" class="absolute inset-0 flex items-center justify-center bg-gray-900/50">
                                    <svg class="w-7 h-7 text-white animate-spin" viewBox="0 0 24 24" fill="none">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                                    </svg>
                                </div>
                            </div>

                            <!-- camera badge -->
                            <span class="absolute bottom-1 right-1 flex items-center justify-center w-9 h-9 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 border-3 border-white dark:border-gray-800 shadow-lg transition-transform duration-200 group-hover:scale-110">
                                <svg class="w-4 h-4 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z" />
                                    <circle cx="12" cy="13" r="4" />
                                </svg>
                            </span>
                        </label>

                        <input id="profileImageInput" type="file" class="hidden" wire:model="profileImage" accept="image/png,image/jpeg">

                        <div class="flex items-center gap-4">
                            <label for="profileImageInput" class="text-sm font-semibold text-primary-600 dark:text-primary-400 hover:text-primary-700 dark:hover:text-primary-300 cursor-pointer transition-colors">
                                Upload new photo
                            </label>

                            @if ($hasCustomImage)
                                <span class="text-gray-300 dark:text-gray-600">|</span>
                                <button
                                    type="button"
                                    wire:click="removeProfileImage"
                                    wire:confirm="Remove your profile picture?"
                                    class="text-sm font-semibold text-red-500 hover:text-red-600 dark:text-red-400 dark:hover:text-red-300 transition-colors">
                                    Remove
                                </button>
                            @endif
                        </div>

                        @error('profileImage')
                        <div class="w-full p-3 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 shadow-sm">
                            <p class="text-xs text-red-600 dark:text-red-400 font-medium text-center">{{ $message }}</p>
                        </div>
                        @enderror
                    </div>
                </div>
                <!-- ============================================= -->
                <!-- END Modernized Profile Picture Card             -->
                <!-- ============================================= -->

                <!-- Modern Details Card -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-3xl border border-gray-200/60 dark:border-gray-700/60 p-7 lg:p-9 shadow-xl hover:shadow-2xl transition-all duration-300 backdrop-blur-sm bg-white/95 dark:bg-gray-800/95">
                    <div class="flex items-center gap-3 mb-7">
                        <div class="p-2 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Personal Information</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">First name</label>
                            <flux:input wire:model="firstname" type="text" placeholder="Juan" autocomplete="given-name" class="rounded-xl" />
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Last name</label>
                            <flux:input wire:model="lastname" type="text" placeholder="Dela Cruz" autocomplete="family-name" class="rounded-xl" />
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Email</label>
                            <flux:input wire:model="email" type="email" placeholder="you@example.com" autocomplete="email" class="rounded-xl" />
                            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                            <div class="mt-4 p-4 rounded-2xl bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 shadow-sm">
                                <div class="flex items-start gap-3">
                                    <div class="p-2 rounded-lg bg-amber-100 dark:bg-amber-900/40 flex-shrink-0">
                                        <svg class="w-5 h-5 text-amber-600 dark:text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm font-bold text-amber-800 dark:text-amber-300">Email not verified</p>
                                        <p class="text-xs text-amber-600 dark:text-amber-400 mt-1.5 font-medium">Your email address is unverified.</p>
                                        <flux:link class="text-xs mt-3 inline-block cursor-pointer font-semibold hover:underline" wire:click.prevent="resendVerificationNotification">
                                            Click here to re-send the verification email.
                                        </flux:link>
                                        @if (session('status') === 'verification-link-sent')
                                        <div class="mt-3 p-3 rounded-xl bg-green-50 dark:bg-green-900/20 border border-green-200 dark:border-green-800 shadow-sm">
                                            <p class="text-xs font-semibold text-green-700 dark:text-green-300">✓ A new verification link has been sent to your email address.</p>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">About you</label>
                            <textarea wire:model="bio" rows="4" class="w-full rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-sm text-gray-800 dark:text-gray-100 px-4 py-3.5 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:border-transparent transition-all duration-200 shadow-sm" placeholder="Tell us about yourself..."></textarea>
                            @error('bio')
                            <div class="mt-3 p-3 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 shadow-sm">
                                <p class="text-xs text-red-600 dark:text-red-400 font-medium">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <!-- Personal Information Section -->
                    <div class="mt-8 pt-7 border-t border-gray-200/60 dark:border-gray-700/60">
                        <h4 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-6">Personal Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Phone Number</label>
                                <flux:input wire:model="phone_number" type="tel" placeholder="+63" class="rounded-xl" />
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Gender</label>
                                <flux:select wire:model="gender" placeholder="Select Gender" class="rounded-xl">
                                    <flux:select.option>Male</flux:select.option>
                                    <flux:select.option>Female</flux:select.option>
                                </flux:select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Birthday</label>
                                <flux:input wire:model="birthday" type="date" max="2999-12-31" class="rounded-xl" />
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Civil Status</label>
                                <flux:select wire:model="civil_status" class="rounded-xl">
                                    <flux:select.option>Single</flux:select.option>
                                    <flux:select.option>Married</flux:select.option>
                                    <flux:select.option>Widow</flux:select.option>
                                    <flux:select.option value="solo_parent">Solo Parent</flux:select.option>
                                </flux:select>
                            </div>
                            <div class="md:col-span-2">
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Address</label>
                                <flux:input wire:model="address" type="text" placeholder="Enter your address" class="rounded-xl" />
                            </div>
                        </div>
                    </div>

                    <!-- Career Information Section -->
                    <div class="mt-8 pt-7 border-t border-gray-200/60 dark:border-gray-700/60">
                        <h4 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-6">Career Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">DTI ID Number</label>
                                <flux:input wire:model="staff_id" type="text" placeholder="Enter DTI ID" class="rounded-xl" />
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Office</label>
                                <flux:select wire:model="office" placeholder="Choose Office" class="rounded-xl">
                                    <flux:select.option>General Santos City</flux:select.option>
                                    <flux:select.option>Sarangani Province</flux:select.option>
                                    <flux:select.option>South Cotabato</flux:select.option>
                                    <flux:select.option>Regional Office</flux:select.option>
                                    <flux:select.option>Sultan Kudarat</flux:select.option>
                                    <flux:select.option>Cotabato Province</flux:select.option>
                                </flux:select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Position</label>
                                <flux:input wire:model="position" type="text" placeholder="Enter position" class="rounded-xl" />
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Department</label>
                                <flux:input wire:model="department" type="text" placeholder="Enter department" class="rounded-xl" />
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Nature of Appointment</label>
                                <flux:select wire:model="nature_of_work" placeholder="Select" class="rounded-xl">
                                    <flux:select.option>Career</flux:select.option>
                                    <flux:select.option>Non-Career</flux:select.option>
                                    <flux:select.option>Contractual</flux:select.option>
                                    <flux:select.option>Job Order</flux:select.option>
                                    <flux:select.option>Casual</flux:select.option>
                                </flux:select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Level</label>
                                <flux:select wire:model="level_career" placeholder="Select Level" class="rounded-xl">
                                    <flux:select.option>1st</flux:select.option>
                                    <flux:select.option>2nd</flux:select.option>
                                    <flux:select.option>3rd</flux:select.option>
                                </flux:select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Years in DTI</label>
                                <flux:input wire:model="years_in_dti" type="number" placeholder="Enter years" min="0" class="rounded-xl" />
                            </div>
                        </div>
                    </div>

                    <!-- Health Information Section -->
                    <div class="mt-8 pt-7 border-t border-gray-200/60 dark:border-gray-700/60">
                        <h4 class="text-lg font-bold text-gray-800 dark:text-gray-100 mb-6">Health Information</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Height (cm)</label>
                                <flux:input wire:model="height" type="number" placeholder="152" class="rounded-xl" />
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Weight (kg)</label>
                                <flux:input wire:model="weight" type="number" placeholder="52" class="rounded-xl" />
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Activity Level</label>
                                <flux:select wire:model="activity_level" placeholder="Select Activity Level" class="rounded-xl">
                                    <flux:select.option>Sedentary</flux:select.option>
                                    <flux:select.option>Lightly Active</flux:select.option>
                                    <flux:select.option>Moderately Active</flux:select.option>
                                    <flux:select.option>Very Active</flux:select.option>
                                    <flux:select.option>Extra Active</flux:select.option>
                                </flux:select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Health Goals</label>
                                <flux:select wire:model="health_goals" placeholder="Select Health Goal" class="rounded-xl">
                                    <flux:select.option>Weight Loss</flux:select.option>
                                    <flux:select.option>Muscle Gain</flux:select.option>
                                    <flux:select.option>Maintenance</flux:select.option>
                                    <flux:select.option>General Fitness</flux:select.option>
                                </flux:select>
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 dark:text-gray-200 mb-3">Dietary Preferences</label>
                                <flux:select wire:model="dietary_preferences" placeholder="Select Preferences" class="rounded-xl">
                                    <flux:select.option>Vegetarian</flux:select.option>
                                    <flux:select.option>Gluten-Free</flux:select.option>
                                    <flux:select.option>Vegan</flux:select.option>
                                    <flux:select.option>Dairy-Free</flux:select.option>
                                    <flux:select.option>Balanced</flux:select.option>
                                    <flux:select.option>Meat-Based</flux:select.option>
                                </flux:select>
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 mt-10 pt-7 border-t border-gray-200/60 dark:border-gray-700/60">
                        <flux:button variant="primary" color="lime" type="submit" class="px-7 py-3.5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105 font-semibold">
                            Save
                        </flux:button>
                        <x-action-message class="me-3 flex items-center gap-2.5 text-sm text-green-600 dark:text-green-400 font-semibold" on="profile-updated">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Saved successfully
                        </x-action-message>
                    </div>
                </div>
            </div>
        </form>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
