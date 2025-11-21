<section class="w-full">
    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="w-full">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
                <!-- Modern Avatar Card -->
                <div class="bg-white dark:bg-gray-800 rounded-3xl border border-gray-200/60 dark:border-gray-700/60 p-7 lg:p-9 shadow-xl hover:shadow-2xl transition-all duration-300 backdrop-blur-sm bg-white/95 dark:bg-gray-800/95">
                    <div class="flex items-center gap-3 mb-3">
                        <div class="p-2 rounded-xl bg-gradient-to-br from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
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
                                class="relative w-28 h-28 rounded-full object-cover border-4 border-gray-200 dark:border-gray-700 shadow-2xl transition-all duration-300 group-hover:scale-110 group-hover:border-primary-400 dark:group-hover:border-primary-500"
                            >
                        </div>

                        <div class="w-full">
                            <label for="profileImageInput" class="inline-flex items-center justify-center gap-2.5 w-full px-5 py-3 text-sm font-semibold rounded-xl cursor-pointer bg-gradient-to-r from-primary-500 to-primary-600 dark:from-primary-600 dark:to-primary-700 text-white hover:from-primary-600 hover:to-primary-700 dark:hover:from-primary-700 dark:hover:to-primary-800 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl hover:scale-105">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4M17 8l-5-5-5 5M12 3v12"/></svg>
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
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
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
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

                    <div class="flex items-center gap-4 mt-10 pt-7 border-t border-gray-200/60 dark:border-gray-700/60">
                        <flux:button variant="primary" type="submit" class="px-7 py-3.5 rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 hover:scale-105 font-semibold">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Save changes
                        </flux:button>
                        <x-action-message class="me-3 flex items-center gap-2.5 text-sm text-green-600 dark:text-green-400 font-semibold" on="profile-updated">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
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
