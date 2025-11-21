<section class="w-full">
    <x-settings.layout :heading="__('Update password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 md:p-8 lg:p-10 shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 rounded-lg bg-primary-100 dark:bg-primary-900/30">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Change Password</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Update your password to keep your account secure</p>
                </div>
            </div>

            <form wire:submit="updatePassword" class="space-y-5">
                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                            {{ __('Current password') }}
                        </span>
                    </label>
                    <flux:input
                        wire:model="current_password"
                        type="password"
                        required
                        autocomplete="current-password"
                        placeholder="Enter your current password"
                    />
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
                            </svg>
                            {{ __('New password') }}
                        </span>
                    </label>
                    <flux:input
                        wire:model="password"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="Enter your new password"
                    />
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5">Use at least 8 characters with a mix of letters, numbers, and symbols</p>
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            {{ __('Confirm Password') }}
                        </span>
                    </label>
                    <flux:input
                        wire:model="password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="Confirm your new password"
                    />
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <flux:button variant="primary" type="submit" class="px-6 py-2.5 shadow-sm hover:shadow transition-shadow duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ __('Save Password') }}
                    </flux:button>

                    <x-action-message class="flex items-center gap-2 text-sm text-green-600 dark:text-green-400 font-medium" on="password-updated">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        {{ __('Password updated successfully') }}
                    </x-action-message>
                </div>
            </form>
        </div>
    </x-settings.layout>
</section>
