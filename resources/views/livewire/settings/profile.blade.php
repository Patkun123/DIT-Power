<section class="w-full">
<<<<<<< HEAD
    <x-settings.layout :heading="__('Profile')" :subheading="__('Manage your profile information')">
        @php
            $user = auth()->user();
            $userInfo = $user->information;
            $staffInfo = $user->staff;
            $coverPhotoUrl = $user->cover_photo ? asset('storage/' . $user->cover_photo) : 'https://images.unsplash.com/photo-1557683316-973673baf926?w=1200&h=400&fit=crop';
            $profileImageUrl = $user->profileimage ? asset('storage/' . $user->profileimage) : asset('images/default.png');
        @endphp

        <!-- Facebook-style Profile Header -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg mb-6">
            <!-- Cover Photo Section -->
            <div class="relative h-64 md:h-80 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500">
                @if($coverPhoto && is_object($coverPhoto) && method_exists($coverPhoto, 'temporaryUrl'))
                    <img src="{{ $coverPhoto->temporaryUrl() }}" alt="Cover" class="w-full h-full object-cover">
                @else
                    <img src="{{ $coverPhotoUrl }}" alt="Cover" class="w-full h-full object-cover">
                @endif
                
                <!-- Cover Photo Edit and Save Buttons -->
                <div class="absolute top-4 right-4 flex flex-col gap-2 items-end">
                    <div class="flex gap-2 flex-wrap">
                        <label for="coverPhotoInput" class="inline-flex items-center gap-2 px-4 py-2 bg-black/50 hover:bg-black/70 backdrop-blur-sm text-white rounded-lg cursor-pointer transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-sm font-medium">Edit Cover</span>
                        </label>
                        <input id="coverPhotoInput" type="file" class="hidden" wire:model="coverPhoto" accept="image/*">
                        
                        <!-- Save Button for Cover Photo - Always Visible -->
                        @if($coverPhoto && is_object($coverPhoto) && method_exists($coverPhoto, 'temporaryUrl'))
                            <button 
                                wire:click="saveCoverPhoto"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 backdrop-blur-sm text-white rounded-lg transition-all shadow-lg"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                <span class="text-sm font-medium">Save Cover</span>
                            </button>
                            <button 
                                wire:click="cancelCoverPhoto"
                                class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 backdrop-blur-sm text-white rounded-lg transition-all shadow-lg"
                            >
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                                <span class="text-sm font-medium">Cancel</span>
                            </button>
                        @endif
=======
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
                <!-- Modern Avatar Card -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-200/60 dark:border-gray-700/60 p-7 lg:p-9 shadow-xl hover:shadow-2xl transition-all duration-300 backdrop-blur-sm bg-white/95 dark:bg-gray-800/95">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="p-2 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100">Profile Picture</h3>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-6 font-medium">PNG/JPG up to 2MB. Square images look best.</p>

                    <div class="flex flex-col items-center gap-5">
                        <!-- Current/Preview Image -->
                        @php
                        $currentImage = auth()->user()->profileimage ? asset('storage/' . auth()->user()->profileimage) : asset('images/default.png');
                        @endphp
                        <div class="relative group">
                            <div class="absolute inset-0 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 opacity-0 group-hover:opacity-30 transition-opacity duration-300 blur-xl"></div>
                            <img
                                src="{{ (is_object($profileImage) && method_exists($profileImage, 'temporaryUrl')) ? $profileImage->temporaryUrl() : $currentImage }}"
                                alt="Profile Preview"
                                class="relative w-28 h-28 rounded-full object-cover border-4 border-gray-200 dark:border-gray-700 shadow-2xl transition-all duration-300 group-hover:scale-110 group-hover:border-primary-400 dark:group-hover:border-primary-500">
                        </div>

                        <div class="w-full">
                            <label for="profileImageInput" class="inline-flex items-center justify-center gap-2.5 w-full px-5 py-3 text-sm font-semibold rounded-xl cursor-pointer bg-gradient-to-r from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 text-white hover:from-primary-600 hover:to-primary-700 dark:hover:from-primary-700 dark:hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M17 8l-5-5-5 5M12 3v12" />
                                </svg>
                                Change photo
                            </label>
                            <input id="profileImageInput" type="file" class="hidden" wire:model="profileImage" accept="image/*">
                            @error('profileImage')
                            <div class="mt-3 p-3 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 shadow-sm">
                                <p class="text-xs text-red-600 dark:text-red-400 font-medium">{{ $message }}</p>
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

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
>>>>>>> Rooffce
                    </div>
                </div>
            </div>

<<<<<<< HEAD
            <!-- Profile Picture and Name Section -->
            <div class="px-4 md:px-8 pb-6">
                <div class="flex flex-col md:flex-row md:items-end md:justify-between -mt-20 md:-mt-24">
                    <!-- Profile Picture -->
                    <div class="relative mb-4 md:mb-0">
                        <div class="relative">
                            @if($profileImage && is_object($profileImage) && method_exists($profileImage, 'temporaryUrl'))
                                <img src="{{ $profileImage->temporaryUrl() }}" alt="Profile" class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-white dark:border-gray-800 object-cover shadow-xl">
                            @else
                                <img src="{{ $profileImageUrl }}" alt="Profile" class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-white dark:border-gray-800 object-cover shadow-xl">
                            @endif
                            <label for="profileImageInput" class="absolute bottom-2 right-2 p-2 bg-blue-600 hover:bg-blue-700 rounded-full cursor-pointer shadow-lg transition-all z-10">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </label>
                            <input id="profileImageInput" type="file" class="hidden" wire:model="profileImage" accept="image/*">
                        </div>
                        
                        <!-- Save/Cancel Buttons for Profile Picture - Always Visible -->
                        <div class="mt-4 flex gap-2 justify-center flex-wrap">
                            @if($profileImage && is_object($profileImage) && method_exists($profileImage, 'temporaryUrl'))
                                <button 
                                    wire:click="saveProfileImage"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-all shadow-lg text-sm font-semibold"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="hidden sm:inline">Save Profile</span>
                                    <span class="sm:hidden">Save</span>
                                </button>
                                <button 
                                    wire:click="cancelProfileImage"
                                    class="inline-flex items-center gap-2 px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg transition-all shadow-lg text-sm font-semibold"
                                >
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                    </svg>
                                    Cancel
                                </button>
                            @else
                                <span class="text-xs text-gray-500 dark:text-gray-400 italic px-2">Select an image to save</span>
                            @endif
                        </div>
                    </div>

                    <!-- Name and Action Buttons -->
                    <div class="flex-1 md:ml-6 md:pb-4">
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-2">
                            {{ $user->firstname }} {{ $user->lastname }}
                        </h1>
                        @if($user->bio)
                            <p class="text-gray-600 dark:text-gray-300 mb-4">{{ $user->bio }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- About Section - Facebook Style -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-lg overflow-hidden">
            <!-- Section Header -->
            <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">About</h2>
            </div>

            <div class="p-6 space-y-6">
                <!-- Basic Information -->
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6 last:border-0 last:pb-0">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Basic Information</h3>
                        @if(!$editingBasicInfo)
                            <button wire:click="$set('editingBasicInfo', true)" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium text-sm flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </button>
                        @endif
                    </div>

                    @if($editingBasicInfo)
                        <form wire:submit="updateBasicInfo" class="space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">First Name</label>
                                    <flux:input wire:model="firstname" type="text" class="w-full" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Last Name</label>
                                    <flux:input wire:model="lastname" type="text" class="w-full" />
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Email</label>
                                <flux:input wire:model="email" type="email" class="w-full" />
                                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                                    <p class="mt-2 text-sm text-amber-600 dark:text-amber-400">
                                        Your email is not verified. 
                                        <button type="button" wire:click="resendVerificationNotification" class="underline">Resend verification email</button>
                                    </p>
                                @endif
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Bio</label>
                                <textarea wire:model="bio" rows="3" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Tell us about yourself..."></textarea>
                            </div>
                            <div class="flex items-center gap-3">
                                <flux:button type="submit" variant="primary">Save</flux:button>
                                <button type="button" wire:click="$set('editingBasicInfo', false)" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">Cancel</button>
                            </div>
                        </form>
                    @else
                        <div class="space-y-3">
                            <div class="flex items-start gap-4">
                                <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Name</div>
                                <div class="flex-1 text-gray-900 dark:text-white">{{ $user->firstname }} {{ $user->lastname }}</div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Email</div>
                                <div class="flex-1 text-gray-900 dark:text-white">{{ $user->email }}</div>
                            </div>
                            @if($user->bio)
                                <div class="flex items-start gap-4">
                                    <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Bio</div>
                                    <div class="flex-1 text-gray-900 dark:text-white">{{ $user->bio }}</div>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Contact Information -->
                <div class="border-b border-gray-200 dark:border-gray-700 pb-6 last:border-0 last:pb-0">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Contact Information</h3>
                        @if(!$editingContactInfo)
                            <button wire:click="$set('editingContactInfo', true)" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium text-sm flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Edit
                            </button>
                        @endif
                    </div>

                    @if($editingContactInfo)
                        <form wire:submit="updateContactInfo" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Phone Number</label>
                                <flux:input wire:model="phone_number" type="tel" class="w-full" />
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Address</label>
                                <flux:input wire:model="address" type="text" class="w-full" />
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Gender</label>
                                    <select wire:model="gender" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2">
                                        <option value="">Select Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Birthday</label>
                                    <flux:input wire:model="birthday" type="date" class="w-full" />
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Civil Status</label>
                                <flux:input wire:model="civil_status" type="text" class="w-full" />
                            </div>
                            <div class="flex items-center gap-3">
                                <flux:button type="submit" variant="primary">Save</flux:button>
                                <button type="button" wire:click="$set('editingContactInfo', false)" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">Cancel</button>
                            </div>
                        </form>
                    @else
                        <div class="space-y-3">
                            @if($userInfo && ($userInfo->phone_number || $userInfo->address || $userInfo->gender || $userInfo->birthday || $userInfo->civil_status))
                                @if($userInfo->phone_number)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Phone</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->phone_number }}</div>
                                    </div>
                                @endif
                                @if($userInfo->address)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Address</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->address }}</div>
                                    </div>
                                @endif
                                @if($userInfo->gender)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Gender</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->gender }}</div>
                                    </div>
                                @endif
                                @if($userInfo->birthday)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Birthday</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->birthday->format('F d, Y') }}</div>
                                    </div>
                                @endif
                                @if($userInfo->civil_status)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Civil Status</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->civil_status }}</div>
                                    </div>
                                @endif
                            @else
                                <p class="text-gray-500 dark:text-gray-400 text-sm">No contact information added yet.</p>
                            @endif
                        </div>
                    @endif
                </div>

                <!-- Work Information -->
                @if($userInfo && ($userInfo->career || $userInfo->level_career || $userInfo->nature_of_work || $userInfo->function || $userInfo->years_in_dti))
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-6 last:border-0 last:pb-0">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Work Information</h3>
                            @if(!$editingWorkInfo)
                                <button wire:click="$set('editingWorkInfo', true)" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </button>
                            @endif
                        </div>

                        @if($editingWorkInfo)
                            <form wire:submit="updateWorkInfo" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Career</label>
                                        <flux:input wire:model="career" type="text" class="w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Level</label>
                                        <flux:input wire:model="level_career" type="text" class="w-full" />
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Years in DTI</label>
                                    <flux:input wire:model="years_in_dti" type="text" class="w-full" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Nature of Work</label>
                                    <flux:input wire:model="nature_of_work" type="text" class="w-full" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Function</label>
                                    <flux:input wire:model="function" type="text" class="w-full" />
                                </div>
                                <div class="flex items-center gap-3">
                                    <flux:button type="submit" variant="primary">Save</flux:button>
                                    <button type="button" wire:click="$set('editingWorkInfo', false)" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">Cancel</button>
                                </div>
                            </form>
                        @else
                            <div class="space-y-3">
                                @if($userInfo->career)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Career</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->career }}</div>
                                    </div>
                                @endif
                                @if($userInfo->level_career)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Level</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->level_career }}</div>
                                    </div>
                                @endif
                                @if($userInfo->years_in_dti)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Years in DTI</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->years_in_dti }}</div>
                                    </div>
                                @endif
                                @if($userInfo->nature_of_work)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Nature of Work</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->nature_of_work }}</div>
                                    </div>
                                @endif
                                @if($userInfo->function)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Function</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->function }}</div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Staff Information -->
                @if($staffInfo)
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-6 last:border-0 last:pb-0">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Staff Information</h3>
                            @if(!$editingStaff)
                                <button wire:click="$set('editingStaff', true)" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </button>
                            @endif
                        </div>

                        @if($editingStaff)
                            <form wire:submit="updateStaffInfo" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Staff ID</label>
                                        <flux:input wire:model="staff_id" type="text" class="w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Office</label>
                                        <flux:input wire:model="office" type="text" class="w-full" />
                                    </div>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Department</label>
                                        <flux:input wire:model="department" type="text" class="w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Position</label>
                                        <flux:input wire:model="position" type="text" class="w-full" />
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <flux:button type="submit" variant="primary">Save</flux:button>
                                    <button type="button" wire:click="$set('editingStaff', false)" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">Cancel</button>
                                </div>
                            </form>
                        @else
                            <div class="space-y-3">
                                @if($staffInfo->staff_id)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Staff ID</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $staffInfo->staff_id }}</div>
                                    </div>
                                @endif
                                @if($staffInfo->office)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Office</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $staffInfo->office }}</div>
                                    </div>
                                @endif
                                @if($staffInfo->department)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Department</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $staffInfo->department }}</div>
                                    </div>
                                @endif
                                @if($staffInfo->position)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Position</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $staffInfo->position }}</div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Education -->
                @if($userInfo && ($userInfo->educational_attachment_type || $userInfo->educational_attachment))
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-6 last:border-0 last:pb-0">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Education</h3>
                            @if(!$editingEducation)
                                <button wire:click="$set('editingEducation', true)" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </button>
                            @endif
                        </div>

                        @if($editingEducation)
                            <form wire:submit="updateEducation" class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Educational Attachment Type</label>
                                    <flux:input wire:model="educational_attachment_type" type="text" class="w-full" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Educational Attachment</label>
                                    <flux:input wire:model="educational_attachment" type="text" class="w-full" />
                                </div>
                                <div class="flex items-center gap-3">
                                    <flux:button type="submit" variant="primary">Save</flux:button>
                                    <button type="button" wire:click="$set('editingEducation', false)" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">Cancel</button>
                                </div>
                            </form>
                        @else
                            <div class="space-y-3">
                                @if($userInfo->educational_attachment_type)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Type</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->educational_attachment_type }}</div>
                                    </div>
                                @endif
                                @if($userInfo->educational_attachment)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Attachment</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->educational_attachment }}</div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endif

                <!-- Health Information -->
                @if($userInfo && ($userInfo->height || $userInfo->weight || $userInfo->activity_level || $userInfo->health_goals || $userInfo->dietary_preferences))
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-6 last:border-0 last:pb-0">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Health Information</h3>
                            @if(!$editingHealth)
                                <button wire:click="$set('editingHealth', true)" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium text-sm flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                    Edit
                                </button>
                            @endif
                        </div>

                        @if($editingHealth)
                            <form wire:submit="updateHealthInfo" class="space-y-4">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Height</label>
                                        <flux:input wire:model="height" type="text" class="w-full" />
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Weight</label>
                                        <flux:input wire:model="weight" type="text" class="w-full" />
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Activity Level</label>
                                    <flux:input wire:model="activity_level" type="text" class="w-full" />
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Health Goals</label>
                                    <textarea wire:model="health_goals" rows="3" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Dietary Preferences</label>
                                    <textarea wire:model="dietary_preferences" rows="3" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
                                </div>
                                <div class="flex items-center gap-3">
                                    <flux:button type="submit" variant="primary">Save</flux:button>
                                    <button type="button" wire:click="$set('editingHealth', false)" class="px-4 py-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg">Cancel</button>
                                </div>
                            </form>
                        @else
                            <div class="space-y-3">
                                @if($userInfo->height)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Height</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->height }}</div>
                                    </div>
                                @endif
                                @if($userInfo->weight)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Weight</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->weight }}</div>
                                    </div>
                                @endif
                                @if($userInfo->activity_level)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Activity Level</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->activity_level }}</div>
                                    </div>
                                @endif
                                @if($userInfo->health_goals)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Health Goals</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->health_goals }}</div>
                                    </div>
                                @endif
                                @if($userInfo->dietary_preferences)
                                    <div class="flex items-start gap-4">
                                        <div class="w-32 text-gray-500 dark:text-gray-400 text-sm font-medium">Dietary Preferences</div>
                                        <div class="flex-1 text-gray-900 dark:text-white">{{ $userInfo->dietary_preferences }}</div>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <!-- Success Messages -->
        <x-action-message class="mt-4 flex items-center gap-2.5 text-sm text-green-600 dark:text-green-400 font-semibold" on="profile-updated">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Profile updated successfully
        </x-action-message>

        <x-action-message class="mt-4 flex items-center gap-2.5 text-sm text-green-600 dark:text-green-400 font-semibold" on="contact-info-updated">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Contact information updated
        </x-action-message>

        <x-action-message class="mt-4 flex items-center gap-2.5 text-sm text-green-600 dark:text-green-400 font-semibold" on="work-info-updated">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            Work information updated
        </x-action-message>

=======
>>>>>>> Rooffce
        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
