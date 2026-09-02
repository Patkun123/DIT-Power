<section class="w-full">
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
                    </div>
                </div>
                <x-action-message class="mt-2 text-sm font-semibold text-green-200" on="cover-photo-updated">
                    Cover photo saved successfully.
                </x-action-message>
            </div>

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

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
