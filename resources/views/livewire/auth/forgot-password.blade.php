<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900">
    <div class="relative w-full max-w-5xl p-4">
        <div class="relative flex bg-white rounded-xl shadow-md dark:shadow-gray-500 dark:bg-gray-800 h-[600px]">

            <!-- Left Side (Form Section) -->
            <div class="w-full md:w-1/2 p-6 flex flex-col items-center justify-center">
                <x-auth-header
                    :title="__('Forgot password')"
                    :description="__('Enter your email and DTI ID to reset your password')"
                />

                <!-- Session Status -->
                <x-auth-session-status class="text-center" :status="session('status')" />

                <form wire:submit="verifyAccount" class="w-full mt-10 max-w-sm space-y-6">
                    <!-- Email Address -->
                    <flux:input
                        wire:model="email"
                        :label="__('Email Address')"
                        type="email"
                        required
                        autofocus
                        placeholder="email@example.com"
                    />

                    <!-- DTI ID -->
                    <flux:input
                        wire:model="staff_id"
                        :label="__('DTI ID')"
                        type="text"
                        required
                        placeholder="Enter your DTI ID"
                    />

                    <flux:button variant="primary" color="lime" type="submit" class="w-full">
                        {{ __('Continue') }}
                    </flux:button>
                </form>

                <div class="space-x-1 rtl:space-x-reverse text-center text-sm text-zinc-400 mt-4">
                    <span>{{ __('Or, return to') }}</span>
                    <flux:link :href="route('login')" wire:navigate>
                        {{ __('log in') }}
                    </flux:link>
                </div>
            </div>

            <!-- Right Side (Optional: image or illustration) -->
            <div class="w-1/2 hidden md:block relative shadow-4xl bg-black shadow-gray-300 rounded-r-lg overflow-hidden">
                <img src="/images/pic/12.jpg" alt="Wellness"
                    class="object-cover opacity-40 w-full h-full">

                <!-- Bottom Text -->
                <div class="absolute bottom-10 left-0 w-full bg-opacity-50 text-white text-center p-4">
                    <h1 class="text-4xl font-extrabold">Your Wellness Journey<br />Starts Here</h1><br>
                    <p class="text-sm">Join our community and take the first step towards a healthier <br> lifestyle</p>
                </div>
            </div>

        </div>
    </div>
</div>
