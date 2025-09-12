<section class="w-full">
    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left: Avatar Card -->
                <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
                    <h3 class="text-sm font-semibold text-gray-800 dark:text-gray-100">Profile Picture</h3>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">PNG/JPG up to 2MB. Square images look best.</p>

                    <div class="mt-4 flex items-center gap-4">
                        <!-- Current/Preview Image -->
                        @php
                            $currentImage = auth()->user()->profileimage ? asset('storage/' . auth()->user()->profileimage) : asset('images/default.png');
                        @endphp
                        <div class="relative">
                            <img
                                src="{{ (is_object($profileImage) && method_exists($profileImage, 'temporaryUrl')) ? $profileImage->temporaryUrl() : $currentImage }}"
                                alt="Profile Preview"
                                class="w-20 h-20 rounded-full object-cover border border-gray-300 dark:border-gray-700"
                            >
                        </div>

                        <div class="flex-1">
                            <label for="profileImageInput" class="inline-flex items-center gap-2 px-3 py-2 text-xs font-medium rounded-lg cursor-pointer bg-primary-600 text-white hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-500">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14M5 12h14"/></svg>
                                Change photo
                            </label>
                            <input id="profileImageInput" type="file" class="hidden" wire:model="profileImage" accept="image/*">
                            @error('profileImage') <div class="text-xs text-red-500 mt-2">{{ $message }}</div> @enderror
                        </div>
                    </div>
                </div>

                <!-- Right: Details Card -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 p-5 shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-200 mb-1">First name</label>
                            <flux:input wire:model="firstname" type="text" placeholder="Juan" autocomplete="given-name" />
                        </div>
                        <div>
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-200 mb-1">Last name</label>
                            <flux:input wire:model="lastname" type="text" placeholder="Dela Cruz" autocomplete="family-name" />
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-200 mb-1">Email</label>
                            <flux:input wire:model="email" type="email" placeholder="you@example.com" autocomplete="email" />
                            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                                <div class="mt-2">
                                    <p class="text-xs text-amber-600 dark:text-amber-400">Your email address is unverified.</p>
                                    <flux:link class="text-xs cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                        Click here to re-send the verification email.
                                    </flux:link>
                                    @if (session('status') === 'verification-link-sent')
                                        <p class="mt-2 text-xs font-medium text-green-600 dark:text-green-400">A new verification link has been sent to your email address.</p>
                                    @endif
                                </div>
                            @endif
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-xs font-medium text-gray-700 dark:text-gray-200 mb-1">About you</label>
                            <textarea wire:model="bio" rows="4" class="w-full rounded-lg border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-900 text-sm text-gray-800 dark:text-gray-100 px-3 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500"></textarea>
                            @error('bio') <div class="text-xs text-red-500 mt-1">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="flex items-center gap-3 mt-6">
                        <flux:button variant="primary" type="submit" class="px-5">
                            Save changes
                        </flux:button>
                        <x-action-message class="me-3" on="profile-updated">
                            Saved.
                        </x-action-message>
                    </div>
                </div>
            </div>
        </form>

        

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
