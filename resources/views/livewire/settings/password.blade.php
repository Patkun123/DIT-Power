<section class="w-full">
    <x-settings.layout :heading="__('Update password')" :subheading="__('Ensure your account is using a long, random password to stay secure')">
        <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 p-6 md:p-8 lg:p-10 shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center gap-3 mb-6">
                <div class="p-2 rounded-lg bg-primary-100 dark:bg-primary-900/30">
                    <svg class="w-6 h-6 text-primary-600 dark:text-primary-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Change Password</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Update your password to keep your account secure</p>
                </div>
            </div>

            <form wire:submit.prevent="updatePassword" class="space-y-5">
                <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
                    {{ __('For security purposes, please verify your current password before making any changes to your account.') }}
                </p>

                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            {{ __('Current password') }}
                        </span>
                    </label>
                    <flux:input
                        wire:model="current_password"
                        type="password"
                        required
                        autocomplete="current-password"
                        placeholder="Enter your current password" />
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                            </svg>
                            {{ __('New password') }}
                        </span>
                    </label>
                    <flux:input
                        wire:model="password"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="Enter your new password" />
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1.5">Use at least 8 characters with a mix of letters, numbers, and symbols</p>
                </div>

                <div class="space-y-1">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-200 mb-2">
                        <span class="flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            {{ __('Confirm Password') }}
                        </span>
                    </label>
                    <flux:input
                        wire:model="password_confirmation"
                        type="password"
                        required
                        autocomplete="new-password"
                        placeholder="Confirm your new password" />
                </div>

                <div class="flex items-center gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <flux:button
                        variant="primary"
                        color="lime"
                        type="submit"
                        class="px-6 py-2.5"
                    >
                        {{ __('Save Password') }}
                    </flux:button>
                </div>
            </form>
        </div>
    </x-settings.layout>

    <!-- Flowbite Success Modal -->
    <div id="successModal" data-modal-backdrop="static" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <button type="button" data-modal-hide="successModal" class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">{{ __('Close modal') }}</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-green-500 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14Z"/>
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m6.5 8.5 2.5 2.5 4-4"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-bold text-gray-900 dark:text-white">{{ __('Success!') }}</h3>
                    <p class="mb-5 text-sm font-normal text-gray-500 dark:text-gray-400">{{ __('Your password has been updated successfully.') }}</p>
                </div>
            </div>
        </div>
    </div>
</section>

@script
<script>
    $wire.on('password-updated', () => {
        // Show modal using Flowbite
        const modal = new Modal(document.getElementById('successModal'), {
            backdrop: 'static'
        });
        modal.show();

        // Auto close modal after 2 seconds
        setTimeout(() => {
            modal.hide();
        }, 2000);
    });
</script>
@endscript
