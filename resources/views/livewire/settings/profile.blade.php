<section class="w-full">
    <x-settings.layout :heading="__('Profile Information')" :subheading="__('Manage your personal information and profile settings')">
        <div class="p-8">
            <form wire:submit="updateProfileInformation" class="space-y-8">
                <!-- Profile Picture Section -->
                <div class="bg-gradient-to-r from-lime-50 to-green-50 dark:from-lime-900/20 dark:to-green-900/20 rounded-xl p-6 border border-lime-200 dark:border-lime-800">
                    <div class="flex items-center gap-6">
                        <!-- Profile Image -->
                        @php
                        $currentImage = auth()->user()->profileimage ? asset('storage/' . auth()->user()->profileimage) : asset('images/default.png');
                        @endphp
                        <div class="relative">
                            <img
                                src="{{ (is_object($profileImage) && method_exists($profileImage, 'temporaryUrl')) ? $profileImage->temporaryUrl() : $currentImage }}"
                                alt="Profile Preview"
                                class="w-24 h-24 rounded-full object-cover border-4 border-white dark:border-gray-700 shadow-lg">
                            <div class="absolute -bottom-1 -right-1 w-8 h-8 bg-lime-500 rounded-full flex items-center justify-center border-2 border-white dark:border-gray-800">
                                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                        </div>

                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Profile Picture</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">Upload a new profile picture. PNG or JPG up to 2MB. Square images work best.</p>

                            <label for="profileImageInput" class="inline-flex items-center gap-2 px-4 py-2 bg-lime-600 hover:bg-lime-700 text-white text-sm font-medium rounded-lg cursor-pointer transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:ring-offset-2">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 5v14M5 12h14" />
                                </svg>
                                Change Photo
                            </label>
                            <input id="profileImageInput" type="file" class="hidden" wire:model="profileImage" accept="image/*">
                            @error('profileImage')
                            <div class="mt-2 text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Personal Information Section -->
                <div class="space-y-6">
                    <div class="border-b border-gray-200 dark:border-gray-700 pb-4">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2">Personal Information</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">Update your basic information and contact details.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Name</label>
                            <flux:input
                                wire:model="firstname"
                                type="text"
                                placeholder="Enter your first name"
                                autocomplete="given-name"
                                class="w-full" />
                            @error('firstname')
                            <div class="text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                            <flux:input
                                wire:model="lastname"
                                type="text"
                                placeholder="Enter your last name"
                                autocomplete="family-name"
                                class="w-full" />
                            @error('lastname')
                            <div class="text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Email Address</label>
                            <flux:input
                                wire:model="email"
                                type="email"
                                placeholder="Enter your email address"
                                autocomplete="email"
                                class="w-full" />
                            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                            <div class="mt-3 p-4 bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800 rounded-lg">
                                <div class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-amber-600 dark:text-amber-400 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z" />
                                    </svg>
                                    <div>
                                        <p class="text-sm font-medium text-amber-800 dark:text-amber-200">Email not verified</p>
                                        <p class="text-sm text-amber-700 dark:text-amber-300 mt-1">Your email address is not verified. Please check your email for a verification link.</p>
                                        <button type="button" wire:click.prevent="resendVerificationNotification" class="mt-2 text-sm text-lime-600 dark:text-lime-400 hover:text-lime-700 dark:hover:text-lime-300 font-medium">
                                            Resend verification email
                                        </button>
                                        @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400 flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                            </svg>
                                            Verification email sent successfully!
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                            @error('email')
                            <div class="text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="md:col-span-2 space-y-2">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">About You</label>
                            <textarea
                                wire:model="bio"
                                rows="4"
                                placeholder="Tell us a little about yourself..."
                                class="w-full rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-sm text-gray-900 dark:text-gray-100 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-lime-500 focus:border-lime-500 resize-none"></textarea>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Optional. Share something about yourself with other users.</p>
                            @error('bio')
                            <div class="text-sm text-red-600 dark:text-red-400 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-between pt-6 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center gap-3">
                        <flux:button variant="primary" type="submit" class="px-6 py-2 bg-lime-600 hover:bg-lime-700 text-white">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Save Changes
                        </flux:button>
                        <x-action-message class="text-sm text-green-600 dark:text-green-400 font-medium" on="profile-updated">
                            <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Profile updated successfully!
                        </x-action-message>
                    </div>

                    <div class="text-sm text-gray-500 dark:text-gray-400">
                        Last updated: {{ auth()->user()->updated_at->format('M j, Y \a\t g:i A') }}
                    </div>
                </div>
            </form>

            <!-- Danger Zone -->
            <div class="mt-12 pt-8 border-t border-red-200 dark:border-red-800">
                <livewire:settings.delete-user-form />
            </div>
        </div>
    </x-settings.layout>
</section>