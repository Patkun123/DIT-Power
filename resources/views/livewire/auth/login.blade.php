<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-gray-900">
    <div class="relative w-full max-w-5xl p-4">
        <div class="relative flex bg-white rounded-xl shadow-md dark:shadow-gray-500 dark:bg-gray-800 h-[600px]">
            <div class="w-full md:w-1/2 p-6 flex items-center justify-center">

                <form wire:submit="login" class="w-full max-w-sm space-y-6">
                    @csrf
                    <div class="space-y-1">
                        <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white text-center space-y-2">Welcome Back</h1>
                    <p class="text-sam text-gray-400 text-center">Sign in to continue to your wellness journey</p>
                    </div>


                    <!-- Email Input -->
                    <div>
                        <flux:input
                            wire:model="email"
                            :label="__('Email address')"
                            type="email"
                            required
                            autofocus
                            autocomplete="email"
                            placeholder="email@example.com"
                        />
                    </div>

                    <!-- Password Input -->
                    <div>
                        <flux:input
                            wire:model="password"
                            :label="__('Password')"
                            type="password"
                            required
                            autocomplete="current-password"
                            :placeholder="__('Password')"
                            viewable
                        />
                    </div>

                    <!-- Remember Me and Forgot -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center space-x-2">
                            <flux:checkbox wire:model="remember" :label="__('Remember me')" />
                        </label>
                        <a href="{{ route(name: 'password.request') }}" class="text-sm text-blue-600 hover:underline dark:text-blue-400">Forgot password?</a>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex items-center justify-end">
                        <flux:button variant="primary" color="lime" type="submit" class="w-full">{{ __('Log in') }}</flux:button>
                    </div>
                </form>

            </div>
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
