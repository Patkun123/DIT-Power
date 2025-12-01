<div class="flex flex-col md:flex-row min-h-screen bg-gray-100 text-gray-900 dark:bg-gray-900 dark:text-white">
    <!-- Left Sidebar -->
    <div class="w-full md:w-1/2 p-6 md:p-10 sm:mt-15 md:mt-0 flex-col dark:bg-gray-800 bg-gray-200 justify-center hidden md:flex lg:block">
        <div class="mx-auto max-w-screen-2xl mt-10 px-4 md:px-8">
            <!-- text - start -->
            <div class="mb-10 md:mb-16">
                <h2 class="mb-4 text-center text-xl font-bold text-gray-700 dark:text-gray-100 md:mb-6 lg:text-3xl">Frequently asked questions</h2>

                <p class="mx-auto max-w-screen-md text-center text-gray-500 dark:text-gray-300 md:text-lg">Get answers to common questions about DIT-Power, our comprehensive wellness platform designed specifically for DTI Region 12 employees.</p>
            </div>
            <!-- text - end -->

            <div class="mx-auto flex max-w-screen-sm flex-col border-gray-700 border-t" x-data="faqDropdown()">
                <!-- question - start -->
                <div class="border-b border-gray-700">
                    <div class="flex cursor-pointer justify-between gap-2 py-4 text-gray-500 dark:text-white hover:text-primary-500 active:text-primary-600"
                        @click="toggleFaq(1)">
                        <span class="font-semibold transition duration-100 md:text-lg">What is DIT-POWeR Hub?</span>

                        <span class="dark:text-white text-gray-400 transition-transform duration-200"
                            :class="{ 'rotate-180': openFaq === 1 }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </div>

                    <div class="overflow-hidden transition-all duration-300 ease-in-out"
                        x-show="openFaq === 1"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-96"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 max-h-96"
                        x-transition:leave-end="opacity-0 max-h-0">
                        <p class="mb-4 text-gray-500 dark:text-gray-300">DIT-Power is a comprehensive Personalized Online Wellness Resource Hub designed for DTI Region 12 employees. It provides health assessments, nutrition guidance, fitness tracking, and wellness resources to help you achieve your health goals.</p>
                    </div>
                </div>
                <!-- question - end -->

                <!-- question - start -->
                <div class="border-b border-gray-700">
                    <div class="flex cursor-pointer justify-between gap-2 py-4 text-gray-500 dark:text-white hover:text-primary-500 active:text-primary-600"
                        @click="toggleFaq(2)">
                        <span class="font-semibold transition duration-100 md:text-lg">How do I get started?</span>

                        <span class="dark:text-white text-gray-400 transition-transform duration-200"
                            :class="{ 'rotate-180': openFaq === 2 }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </div>

                    <div class="overflow-hidden transition-all duration-300 ease-in-out"
                        x-show="openFaq === 2"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-96"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 max-h-96"
                        x-transition:leave-end="opacity-0 max-h-0">
                        <p class="mb-4 text-gray-500 dark:text-gray-300">Simply complete the registration form on this page. You'll need to provide your personal information, health profile, dietary preferences, and create a secure password. Once registered, you can access all wellness features and resources.</p>
                    </div>
                </div>
                <!-- question - end -->

                <!-- question - start -->
                <div class="border-b border-gray-700">
                    <div class="flex cursor-pointer justify-between gap-2 py-4 text-gray-500 dark:text-white hover:text-primary-500 active:text-primary-600"
                        @click="toggleFaq(3)">
                        <span class="font-semibold transition duration-100 md:text-lg">What features are available?</span>

                        <span class="dark:text-white text-gray-400 transition-transform duration-200"
                            :class="{ 'rotate-180': openFaq === 3 }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </div>

                    <div class="overflow-hidden transition-all duration-300 ease-in-out"
                        x-show="openFaq === 3"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-96"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 max-h-96"
                        x-transition:leave-end="opacity-0 max-h-0">
                        <p class="mb-4 text-gray-500 dark:text-gray-300">DIT-Power offers comprehensive wellness features including health assessments, personalized nutrition plans, fitness tracking, wellness quizzes, social wellness feed, financial wellness tools, and access to health professionals and resources.</p>
                    </div>
                </div>
                <!-- question - end -->

                <!-- question - start -->
                <div class="border-b border-gray-700">
                    <div class="flex cursor-pointer justify-between gap-2 py-4 text-gray-500 dark:text-white hover:text-primary-500 active:text-primary-600"
                        @click="toggleFaq(4)">
                        <span class="font-semibold transition duration-100 md:text-lg">Is my data secure?</span>

                        <span class="dark:text-white text-gray-400 transition-transform duration-200"
                            :class="{ 'rotate-180': openFaq === 4 }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </div>

                    <div class="overflow-hidden transition-all duration-300 ease-in-out"
                        x-show="openFaq === 4"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-96"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 max-h-96"
                        x-transition:leave-end="opacity-0 max-h-0">
                        <p class="mb-4 text-gray-500 dark:text-gray-300">Yes, your data is completely secure. We use industry-standard encryption and security measures to protect your personal and health information. Your data is only accessible to you and authorized DTI personnel for wellness program management.</p>
                    </div>
                </div>
                <!-- question - end -->

                <!-- question - start -->
                <div class="border-b border-gray-700">
                    <div class="flex cursor-pointer justify-between gap-2 py-4 text-gray-500 dark:text-white hover:text-primary-500 active:text-primary-600"
                        @click="toggleFaq(5)">
                        <span class="font-semibold transition duration-100 md:text-lg">How can I get support?</span>

                        <span class="dark:text-white text-gray-400 transition-transform duration-200"
                            :class="{ 'rotate-180': openFaq === 5 }">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </span>
                    </div>

                    <div class="overflow-hidden transition-all duration-300 ease-in-out"
                        x-show="openFaq === 5"
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 max-h-0"
                        x-transition:enter-end="opacity-100 max-h-96"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 max-h-96"
                        x-transition:leave-end="opacity-0 max-h-0">
                        <p class="mb-4 text-gray-500 dark:text-gray-300">You can get support through our in-app messaging system, contact the DTI Region 12 wellness team, or reach out to your local office administrator. We also provide comprehensive help documentation and tutorials within the platform.</p>
                    </div>
                </div>
                <!-- question - end -->
            </div>
        </div>
    </div>

    <!-- Right Form Section -->
    <div class="w-full md:w-1/2 p-6 md:p-10 sm:mt-15 md:mt-0 flex flex-col justify-center">

        <!-- Auth Header -->
        <x-auth-header
            :title="__('Fill up the Requirements')"
            :description="__('Step ' . $step . ' of 4')" />

        <!-- Step Progress Tracker -->
        <ol class="grid grid-cols-2 sm:grid-cols-1 mt-8 ml-3 sm:mt-10 lg:grid-cols-4 gap-6 w-full">
            @foreach ([1 => 'Account', 2 => 'HR Profile', 3 => 'Health Profile', 4 => 'Password'] as $i => $label)
            <li class="flex items-center space-x-2.5 rtl:space-x-reverse text-sm
                    @if($step === $i) text-primary-600 dark:text-primary-500
                    @elseif($step > $i)  text-primary-700 dark:text-primary-400
                    @else text-gray-500 dark:text-gray-400 @endif">

                {{-- Step Circle --}}
                <span class="flex items-center justify-center w-8 h-8 rounded-full shrink-0 border
                        @if($step === $i) bg-primary-600 border-primary-600 text-primary-50 dark:border-primary-500 dark:text-gray-900
                        @elseif($step > $i) border-primary-700 text-primary-700 dark:border-primary-400 dark:text-primary-400
                        @else border-gray-500 text-gray-500 dark:border-gray-400 dark:text-gray-400 @endif">

                    @if($step > $i)
                    <!-- Show checkmark if completed -->
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                    @else
                    <!-- Otherwise show step number -->
                    {{ $i }}
                    @endif
                </span>


                {{-- Step Label --}}
                <span>
                    <h3 class="font-medium leading-tight">{{ $label }}</h3>
                    <p class="text-xs">
                        @if($i === 1) Personal Details
                        @elseif($i === 2) Career Information
                        @elseif($i === 3) Health Profile
                        @elseif($i === 4) Secure with a password
                        @endif
                    </p>
                </span>
            </li>
            @endforeach
        </ol>

        <!-- Form Card -->
        <div class="dark:bg-gray-900 bg-gray-100 p-6 space-y-10">
            <x-auth-session-status class="text-center" :status="session('status')" />

            @if (session()->has('success'))
                <div class="p-4 mb-4 text-sm text-green-800 bg-green-50 dark:bg-green-900/20 dark:text-green-200 border border-green-200 dark:border-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session()->has('error'))
                <div class="p-4 mb-4 text-sm text-red-800 bg-red-50 dark:bg-red-900/20 dark:text-red-200 border border-red-200 dark:border-red-800 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <form wire:submit.prevent="{{ $step === 4 ? 'register' : 'nextStep' }}" class="space-y-6">
                @if ($step === 1)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input wire:model.defer="firstname" icon="user-circle" :label="__('First Name')" placeholder="First name" required />
                    <flux:input wire:model.defer="lastname" icon="user-circle" :label="__('Last Name')" placeholder="Last name" required />
                    <flux:select wire:model.defer="gender" placeholder="Select Gender" :label="__('Gender')">
                        <flux:select.option>Male</flux:select.option>
                        <flux:select.option>Female</flux:select.option>
                    </flux:select>
                    <flux:input type="date" max="2999-12-31" wire:model.defer="birthday" :label="__('Birthday')"></flux:input>
                    <flux:input
                        type="tel"
                        wire:model.defer="phone_number"
                        icon="phone"
                        :label="__('Phone Number')"
                        placeholder="+63"
                        required />
                    <flux:select wire:model.defer="civil_status" :label="__('Civil Status')">
                        <flux:select.option>Married</flux:select.option>
                        <flux:select.option>Single</flux:select.option>
                        <flux:select.option>Widow</flux:select.option>
                        <flux:select.option value="solo_parent">Solo Parent</flux:select.option>
                    </flux:select>
                </div>
                <div class="grid grid-cols-1 gap-6">
                    <flux:input wire:model.defer="address" icon="map-pin" :label="__('Address')" placeholder="Address" required />
                </div>
                @endif
                @if ($step === 2)
                <!-- HR Profile - Career Information -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input
                        type="text"
                        wire:model.defer="staff_id"
                        icon="identification"
                        :label="__('DTI ID Number')"
                        placeholder="Enter your DTI ID"
                        required />
                    <flux:select wire:model.defer="career" :label="__('Nature of Appointment')" required>
                        <flux:select.option>Career</flux:select.option>
                        <flux:select.option>Non-Career</flux:select.option>
                    </flux:select>
                    <flux:select wire:model.defer="level_career" :label="__('Level')">
                        <flux:select.option>1st</flux:select.option>
                        <flux:select.option>2nd</flux:select.option>
                        <flux:select.option>3rd</flux:select.option>
                    </flux:select>
                    <flux:input
                        type="text"
                        wire:model.defer="years_in_dti"
                        icon="calendar"
                        :label="__('Years in DTI')"
                        placeholder="e.g., 5 years"
                    />
                    <flux:select wire:model.defer="office" :label="__('Office')" placeholder="Choose Office..." required>
                        <flux:select.option>General Santos City</flux:select.option>
                        <flux:select.option>Sarangani Province</flux:select.option>
                        <flux:select.option>South Cotabato</flux:select.option>
                        <flux:select.option>Regional Office</flux:select.option>
                        <flux:select.option>Sultan Kudarat</flux:select.option>
                        <flux:select.option>Cotabato Province</flux:select.option>
                    </flux:select>
                    <flux:input wire:model.defer="position" icon="user-circle" :label="__('Position')" placeholder="Enter your Position" required />
                    <flux:input wire:model.defer="department" icon="user-circle" :label="__('Department')" placeholder="Enter your Department" required />
                </div>
                @endif

                @if ($step === 3)
                <!-- Health Profile -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input type="number" icon="circle-stack" wire:model.defer="height" :label="__('Height')" placeholder="152 (cm)" required />
                    <flux:input wire:model.defer="weight" icon="circle-stack" :label="__('Weight (kg)')" placeholder="52 (kg)" required />
                    <flux:select wire:model.defer="activity_level" placeholder="Select Activity Level" :label="__('Activity Level')">
                        <flux:select.option>Sedentary</flux:select.option>
                        <flux:select.option>Lightly Active</flux:select.option>
                        <flux:select.option>Moderately Active</flux:select.option>
                        <flux:select.option>Very Active</flux:select.option>
                        <flux:select.option>Extra Active</flux:select.option>
                    </flux:select>
                    <flux:select wire:model.defer="health_goals" placeholder="Select Health Goals" :label="__('Health Goal')">
                        <flux:select.option>Weight Loss</flux:select.option>
                        <flux:select.option>Muscle Gain</flux:select.option>
                        <flux:select.option>Maintenance</flux:select.option>
                        <flux:select.option>General Fitness</flux:select.option>
                    </flux:select>
                </div>
                <div class="grid grid-cols-1 gap-6 mt-6">
                    <flux:radio.group class="grid grid-cols-2 gap-5" wire:model.defer="dietary_preferences" :label="__('Preferences')">
                        <flux:radio
                            value="Vegetarian"
                            label="Vegetarian"
                            description="dietary practice that excludes the consumption of meat, poultry, fish, and seafood."
                            checked />
                        <flux:radio
                            value="Gluten-Free"
                            label="Gluten-Free"
                            description="Avoids gluten, a protein found in wheat, barley, and rye." />
                        <flux:radio
                            value="Vegan"
                            label="Vegan"
                            description="Excludes all animal products, including meat, dairy, eggs, and honey." />
                        <flux:radio
                            value="Dairy-Free"
                            label="Dairy-Free"
                            description="Eliminates milk and dairy products (cheese, yogurt, butter)." />
                        <flux:radio
                            value="Balanced"
                            label="Balanced"
                            description="A balance between meat, vegetable, fruits, grains, and dairy." />
                        <flux:radio
                            value="meat-based"
                            label="Meat-Based"
                            description="Heavily relies on meat and a few grams of other nutrients" />
                    </flux:radio.group>
                </div>
                @endif

                @if ($step === 4)
                <!-- Password -->
                @php
                    $userHasPassword = auth()->check() && !empty(auth()->user()->password);
                @endphp
                @if($userHasPassword)
                <div class="mb-4 p-3 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-lg">
                    <p class="text-sm text-blue-800 dark:text-blue-200">
                        <strong>Note:</strong> You already have a password. Leave these fields blank to keep your current password, or enter a new password to change it.
                    </p>
                </div>
                @endif
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <flux:input
                        type="password"
                        wire:model.defer="password"
                        :label="__($userHasPassword ? 'Password (Optional)' : 'Password')"
                        placeholder="Enter password"
                        :required="!$userHasPassword" />
                    <flux:input
                        type="password"
                        wire:model.defer="password_confirmation"
                        :label="__($userHasPassword ? 'Confirm Password (Optional)' : 'Confirm Password')"
                        placeholder="Re-enter password"
                        :required="!$userHasPassword" />
                </div>
                @endif


                <!-- Buttons -->
                <div class="flex justify-between items-center pt-4">
                    @if ($step > 1)
                    <flux:button type="button" variant="danger" icon="arrow-left" wire:click="previousStep">
                        {{ __('Back') }}
                    </flux:button>
                    @endif

                    <flux:button type="submit" variant="primary" color="lime" icon="arrow-right" class="ml-auto">
                        {{ $step === 4 ? __('Submit') : __('Next') }}
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function faqDropdown() {
        return {
            openFaq: null,

            toggleFaq(faqNumber) {
                // If clicking the same FAQ, close it; otherwise, open the new one
                this.openFaq = this.openFaq === faqNumber ? null : faqNumber;
            }
        }
    }
</script>
