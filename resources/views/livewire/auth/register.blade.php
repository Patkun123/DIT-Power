<div class="flex flex-col md:flex-row min-h-screen bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white">
    <!-- Left Sidebar -->
    <div class="w-full md:w-1/2 bg-blue-700 p-8  flex-col justify-center hidden md:flex lg:block">
        {{-- <a href="#" class="text-white text-lg mb-4">&larr; Go back</a>
            <h2 class="text-white text-xl font-semibold mb-2">Your selected plan</h2>
            <p class="text-blue-200 mb-4">30-day free trial</p>
            <ul class="text-sm space-y-2">
                <li>✅ Individual configuration</li>
                <li>✅ No setup, or hidden fees</li>
                <li>✅ Team size: <span class="font-bold">1 developer</span></li>
                <li>✅ Premium support: <span class="font-bold">6 months</span></li>
                <li>✅ Free updates: <span class="font-bold">6 months</span></li>
            </ul> --}}
    </div>

    <!-- Right Form Section -->
    <div class="w-full md:w-1/2 p-6 md:p-10 sm:mt-15 md:mt-0 flex flex-col justify-center">
        <!-- Auth Header -->
        <x-auth-header
            :title="__('Fill up the Requirements')"
            :description="__('Step ' . $step . ' of 4')"
        />

        <!-- Step Progress Tracker -->
<ol class="grid grid-cols-2 sm:grid-cols-1 mt-8 ml-3 sm:mt-10 lg:grid-cols-4 gap-6 w-full">
    @foreach ([1 => 'Account', 2 => 'Profile', 3 => 'Preferences', 4 => 'Password'] as $i => $label)
        <li class="flex items-center space-x-2.5 rtl:space-x-reverse
            @if($step === $i) text-primary-600 dark:text-primary-500
            @elseif($step > $i) text-primary-700 dark:text-primary-400
            @else text-gray-500 dark:text-gray-400 @endif">

            {{-- Step Circle --}}
            <span class="flex items-center justify-center w-8 h-8 rounded-full shrink-0 border
                @if($step === $i) border-primary-600 text-primary-600 dark:border-primary-500 dark:text-primary-500
                @elseif($step > $i) border-primary-700 text-primary-700 dark:border-primary-400 dark:text-primary-400
                @else border-gray-500 text-gray-500 dark:border-gray-400 dark:text-gray-400 @endif">
                {{ $i }}
            </span>

            {{-- Step Label --}}
            <span>
                <h3 class="font-medium leading-tight">{{ $label }}</h3>
                <p class="text-sm">
                    @if($i === 1) Start your account setup
                    @elseif($i === 2) Complete your Health profile
                    @elseif($i === 3) Choose your preferences
                    @elseif($i === 4) Secure with a password
                    @endif
                </p>
            </span>
        </li>
    @endforeach
</ol>



        <!-- Form Card -->
        <div class="dark:bg-gray-900 bg-gray-100 p-6 rounded-lg shadow space-y-10">
            <x-auth-session-status class="text-center" :status="session('status')" />

            <form wire:submit.prevent="{{ $step === 4 ? 'register' : 'nextStep' }}" class="space-y-6">
                @if ($step === 1)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <flux:input wire:model.defer="firstname" icon="user-circle" :label="__('First Name')" placeholder="First name" required />
                        <flux:input wire:model.defer="lastname" icon="user-circle" :label="__('Last Name')" placeholder="Last name" required />
                        <flux:select wire:model.defer="gender" placeholder="Select Gender" :label="_('Gender')">
                            <flux:select.option>Male</flux:select.option>
                            <flux:select.option>Female</flux:select.option>
                        </flux:select>
                        <flux:input type="date" max="2999-12-31" wire:model.defer="birthday" :label="__('Birthday')"></flux:input>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                            <flux:input wire:model.defer="address" icon="map-pin" :label="__('address')" placeholder="Address" required />
                            <flux:input wire:model.defer="phone_number" icon="phone" :label="__('Phone Number')" placeholder="+63" required />
                        </div>

                @endif

                @if ($step === 2)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <flux:input type="number" icon="circle-stack" wire:model.defer="height" :label="__('Height')" placeholder="152 (cm)" required />
                        <flux:input wire:model.defer="weight" icon="circle-stack" :label="__('Weight (kg)')" placeholder="52 (kg)" required />
                        <flux:select wire:model="activity_level" placeholder="Select Activity Level" :label="__('Activity Level')">
                            <flux:select.option>Sendentry</flux:select.option>
                            <flux:select.option>Lightly Active</flux:select.option>
                            <flux:select.option>Moderately Active</flux:select.option>
                            <flux:select.option>Very Active</flux:select.option>
                            <flux:select.option>Extra Active</flux:select.option>
                        </flux:select>
                        <flux:select wire:model="health_goals" placeholder="Select Activity Level" :label="__('Activity Level')">
                            <flux:select.option>Weight Loss</flux:select.option>
                            <flux:select.option>Muscle Gain</flux:select.option>
                            <flux:select.option>Maintenance</flux:select.option>
                            <flux:select.option>General Fitness</flux:select.option>
                        </flux:select>
                    </div>
                @endif

                @if ($step === 3)
                    <div class="grid grid-cols-1 gap-6">
                        <flux:radio.group class="grid grid-cols-2 gap-5" wire:model="dietary_preferences" :label="_('Dietary Preferences')">
                            <flux:radio
                                value="Vegetarian"
                                label="Vegetarian"
                                description="dietary practice that excludes the consumption of meat, poultry, fish, and seafood."
                                checked
                            />
                            <flux:radio
                                value="Gluten-Free"
                                label="Gluten-Free"
                                description="Avoids gluten, a protein found in wheat, barley, and rye."
                            />
                            <flux:radio
                                value="Vegan"
                                label="Vegan"
                                description="Excludes all animal products, including meat, dairy, eggs, and honey."
                            />
                            <flux:radio
                                value="Dairy-Free"
                                label="Dairy-Free"
                                description="Eliminates milk and dairy products (cheese, yogurt, butter)."
                            />
                        </flux:radio.group>
                    </div>
                @endif

                @if ($step === 4)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input
                        type="number"
                        wire:model.defer="staff_id"
                        :label="__('DTI ID')"
                        placeholder="Enter you DTI ID"
                    />
                    <flux:input wire:model.defer="position" icon="user-circle" :label="__('Position (Optional)')" placeholder="Enter your Position" required />
                    <flux:input wire:model.defer="department" icon="user-circle" :label="__('Departmet (Optional)')" placeholder="Enter your Departmet" required />
                    <flux:select wire:model.defer="office" :label="__('Choose Office')" placeholder="Choose Department...">
                        <flux:select.option>General Santos City</flux:select.option>
                        <flux:select.option>Sarangani Province</flux:select.option>
                        <flux:select.option>South Cotabato</flux:select.option>
                        <flux:select.option>Regional Office</flux:select.option>
                        <flux:select.option>Sultan Kudarat</flux:select.option>
                        <flux:select.option>Cotabato Province</flux:select.option>
                    </flux:select>
                    <flux:input
                        type="password"
                        wire:model.defer="password"
                        :label="__('New Password')"
                        placeholder="Enter new password"
                    />
                    <flux:input
                        type="password"
                        wire:model.defer="password_confirmation"
                        :label="__('Confirm Password')"
                        placeholder="Re-enter password"
                    />
                </div>
            @endif


                <!-- Buttons -->
                <div class="flex justify-between items-center pt-4">
                    @if ($step > 1)
                        <flux:button type="button" variant="danger" icon="arrow-left" wire:click="previousStep">
                            {{ __('Back') }}
                        </flux:button>
                    @endif

                    <flux:button type="submit" variant="primary" icon="arrow-right" class="ml-auto">
                        {{ $step === 4 ? __('Submit') : __('Next') }}
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</div>
