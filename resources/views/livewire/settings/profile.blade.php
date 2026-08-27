<section class="w-full">
    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">

        <!-- ============================================= -->
        <!-- Cover + Avatar block (Facebook profile style)   -->
        <!-- ============================================= -->
        <div class="bg-white dark:bg-[#242526] rounded-lg border border-gray-200 dark:border-gray-700 overflow-hidden mb-4">
            <!-- cover -->
            <div class="h-24 md:h-28 bg-gradient-to-r from-blue-400 to-blue-600"></div>

            <div class="px-5 pb-5">
                @php
                    $hasCustomImage = auth()->user()->profileimage;
                    $currentImage = $hasCustomImage ? asset('storage/' . auth()->user()->profileimage) : asset('images/default.png');
                    $previewSrc = (is_object($profileImage) && method_exists($profileImage, 'temporaryUrl'))
                        ? $profileImage->temporaryUrl()
                        : $currentImage;
                @endphp

                <div class="flex flex-col sm:flex-row sm:items-end gap-4 -mt-10">
                    <!-- Avatar -->
                    <label for="profileImageInput" class="relative group cursor-pointer block flex-shrink-0">
                        <div class="w-24 h-24 rounded-full overflow-hidden border-4 border-white dark:border-[#242526] bg-white dark:bg-[#242526] shadow-sm">
                            <img
                                wire:loading.class="opacity-40"
                                wire:target="profileImage"
                                src="{{ $previewSrc }}"
                                alt="Profile Preview"
                                class="w-full h-full object-cover">
                        </div>

                        <!-- uploading spinner -->
                        <div wire:loading wire:target="profileImage" class="absolute inset-0 flex items-center justify-center bg-gray-900/40 rounded-full">
                            <svg class="w-6 h-6 text-white animate-spin" viewBox="0 0 24 24" fill="none">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                        </div>

                        <!-- camera badge -->
                        <span class="absolute bottom-0.5 right-0.5 flex items-center justify-center w-8 h-8 rounded-full bg-gray-200 dark:bg-[#3a3b3c] border-2 border-white dark:border-[#242526] shadow-sm group-hover:bg-gray-300 dark:group-hover:bg-[#4e4f50] transition-colors">
                            <svg class="w-4 h-4 text-gray-700 dark:text-gray-200" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M23 19a2 2 0 01-2 2H3a2 2 0 01-2-2V8a2 2 0 012-2h4l2-3h6l2 3h4a2 2 0 012 2z" />
                                <circle cx="12" cy="13" r="4" />
                            </svg>
                        </span>
                    </label>
                    <input id="profileImageInput" type="file" class="hidden" wire:model="profileImage" accept="image/png,image/jpeg">

                    <div class="flex-1 min-w-0 pb-1">
                        <div class="text-xl font-bold text-gray-900 dark:text-gray-100 truncate">{{ $firstname }} {{ $lastname }}</div>
                        <div class="text-sm text-gray-500 dark:text-gray-400 truncate">{{ $position ?? __('No position set') }}{{ $office ? ' · ' . $office : '' }}</div>
                    </div>

                    <div class="flex items-center gap-2 pb-1">
                        <label for="profileImageInput" class="cursor-pointer text-sm font-semibold px-3.5 py-2 rounded-md bg-gray-100 dark:bg-[#3a3b3c] text-gray-800 dark:text-gray-100 hover:bg-gray-200 dark:hover:bg-[#4e4f50] transition-colors">
                            {{ __('Edit photo') }}
                        </label>
                        @if ($hasCustomImage)
                            <button
                                type="button"
                                wire:click="removeProfileImage"
                                wire:confirm="Remove your profile picture?"
                                class="text-sm font-semibold px-3.5 py-2 rounded-md bg-gray-100 dark:bg-[#3a3b3c] text-red-600 dark:text-red-400 hover:bg-gray-200 dark:hover:bg-[#4e4f50] transition-colors">
                                {{ __('Remove') }}
                            </button>
                        @endif
                    </div>
                </div>

                @error('profileImage')
                <p class="mt-3 text-xs text-red-600 dark:text-red-400 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- ============================================= -->
        <!-- Account overview — Facebook "About" list style  -->
        <!-- ============================================= -->
        <div class="bg-white dark:bg-[#242526] rounded-lg border border-gray-200 dark:border-gray-700 mb-4">
            <div class="px-5 pt-4 pb-2">
                <h3 class="text-[17px] font-bold text-gray-900 dark:text-gray-100">{{ __('Account overview') }}</h3>
            </div>

            <div class="divide-y divide-gray-100 dark:divide-gray-700">
                @php
                    $overviewGroups = [
                        __('Personal details') => [
                            __('Name') => trim($firstname . ' ' . $lastname),
                            __('Email') => $email,
                            __('Phone') => $phone_number,
                            __('Gender') => $gender,
                            __('Birthday') => $birthday ? \Carbon\Carbon::parse($birthday)->format('M d, Y') : null,
                            __('Address') => $address,
                            __('Civil status') => $civil_status,
                        ],
                        __('Career information') => [
                            __('DTI ID') => $staff_id,
                            __('Office') => $office,
                            __('Position') => $position,
                            __('Department') => $department,
                            __('Nature of work') => $nature_of_work,
                            __('Level') => $level_career,
                            __('Years in DTI') => $years_in_dti,
                        ],
                        __('Health information') => [
                            __('Height') => $height ? $height . ' cm' : null,
                            __('Weight') => $weight ? $weight . ' kg' : null,
                            __('Activity level') => $activity_level,
                            __('Health goals') => $health_goals,
                            __('Dietary preference') => $dietary_preferences,
                        ],
                    ];
                @endphp

                @foreach ($overviewGroups as $groupLabel => $fields)
                    <div class="px-5 py-3.5">
                        <h4 class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wide mb-2.5">{{ $groupLabel }}</h4>
                        <div class="space-y-2">
                            @foreach ($fields as $label => $value)
                                <div class="flex items-start gap-2 text-sm">
                                    <span class="text-gray-500 dark:text-gray-400 min-w-[130px] flex-shrink-0">{{ $label }}</span>
                                    <span class="text-gray-900 dark:text-gray-100 font-medium">{{ $value ?: __('Not set') }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- ============================================= -->
        <!-- Edit form — grouped Facebook-style sections     -->
        <!-- ============================================= -->
        <form wire:submit="updateProfileInformation" class="space-y-4">

            <!-- Basic info -->
            <div class="bg-white dark:bg-[#242526] rounded-lg border border-gray-200 dark:border-gray-700 p-5">
                <h3 class="text-[17px] font-bold text-gray-900 dark:text-gray-100 mb-4">{{ __('Basic information') }}</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('First name') }}</label>
                        <flux:input wire:model="firstname" type="text" placeholder="Juan" autocomplete="given-name" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Last name') }}</label>
                        <flux:input wire:model="lastname" type="text" placeholder="Dela Cruz" autocomplete="family-name" />
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Email') }}</label>
                        <flux:input wire:model="email" type="email" placeholder="you@example.com" autocomplete="email" />

                        @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                        <div class="mt-3 p-3 rounded-lg bg-amber-50 dark:bg-amber-900/20 border border-amber-200 dark:border-amber-800">
                            <p class="text-sm font-semibold text-amber-800 dark:text-amber-300">{{ __('Email not verified') }}</p>
                            <p class="text-xs text-amber-700 dark:text-amber-400 mt-1">{{ __('Your email address is unverified.') }}</p>
                            <flux:link class="text-xs mt-2 inline-block cursor-pointer font-semibold hover:underline" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click here to re-send the verification email.') }}
                            </flux:link>
                            @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 text-xs font-semibold text-green-700 dark:text-green-400">✓ {{ __('A new verification link has been sent to your email address.') }}</p>
                            @endif
                        </div>
                        @endif
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('About you') }}</label>
                        <textarea wire:model="bio" rows="3"
                            class="w-full rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-[#3a3b3c] text-sm text-gray-900 dark:text-gray-100 px-3 py-2.5 focus:outline-none focus:ring-2 focus:ring-blue-500/40 focus:border-blue-500 transition-colors"
                            placeholder="{{ __('Tell us about yourself...') }}"></textarea>
                        @error('bio')
                        <p class="mt-1.5 text-xs text-red-600 dark:text-red-400 font-medium">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Personal information -->
            <div class="bg-white dark:bg-[#242526] rounded-lg border border-gray-200 dark:border-gray-700 p-5">
                <h3 class="text-[17px] font-bold text-gray-900 dark:text-gray-100 mb-4">{{ __('Personal information') }}</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Phone number') }}</label>
                        <flux:input wire:model="phone_number" type="tel" placeholder="+63" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Gender') }}</label>
                        <flux:select wire:model="gender" placeholder="Select Gender">
                            <flux:select.option>Male</flux:select.option>
                            <flux:select.option>Female</flux:select.option>
                        </flux:select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Birthday') }}</label>
                        <flux:input wire:model="birthday" type="date" max="2999-12-31" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Civil status') }}</label>
                        <flux:select wire:model="civil_status">
                            <flux:select.option>Single</flux:select.option>
                            <flux:select.option>Married</flux:select.option>
                            <flux:select.option>Widow</flux:select.option>
                            <flux:select.option value="solo_parent">Solo Parent</flux:select.option>
                        </flux:select>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Address') }}</label>
                        <flux:input wire:model="address" type="text" placeholder="{{ __('Enter your address') }}" />
                    </div>
                </div>
            </div>

            <!-- Career information -->
            <div class="bg-white dark:bg-[#242526] rounded-lg border border-gray-200 dark:border-gray-700 p-5">
                <h3 class="text-[17px] font-bold text-gray-900 dark:text-gray-100 mb-4">{{ __('Career information') }}</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('DTI ID Number') }}</label>
                        <flux:input wire:model="staff_id" type="text" placeholder="{{ __('Enter DTI ID') }}" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Office') }}</label>
                        <flux:select wire:model="office" placeholder="Choose Office">
                            <flux:select.option>General Santos City</flux:select.option>
                            <flux:select.option>Sarangani Province</flux:select.option>
                            <flux:select.option>South Cotabato</flux:select.option>
                            <flux:select.option>Regional Office</flux:select.option>
                            <flux:select.option>Sultan Kudarat</flux:select.option>
                            <flux:select.option>Cotabato Province</flux:select.option>
                        </flux:select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Position') }}</label>
                        <flux:input wire:model="position" type="text" placeholder="{{ __('Enter position') }}" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Department') }}</label>
                        <flux:input wire:model="department" type="text" placeholder="{{ __('Enter department') }}" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Nature of appointment') }}</label>
                        <flux:select wire:model="nature_of_work" placeholder="Select">
                            <flux:select.option>Career</flux:select.option>
                            <flux:select.option>Non-Career</flux:select.option>
                            <flux:select.option>Contractual</flux:select.option>
                            <flux:select.option>Job Order</flux:select.option>
                            <flux:select.option>Casual</flux:select.option>
                        </flux:select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Level') }}</label>
                        <flux:select wire:model="level_career" placeholder="Select Level">
                            <flux:select.option>1st</flux:select.option>
                            <flux:select.option>2nd</flux:select.option>
                            <flux:select.option>3rd</flux:select.option>
                        </flux:select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Years in DTI') }}</label>
                        <flux:input wire:model="years_in_dti" type="number" placeholder="{{ __('Enter years') }}" min="0" />
                    </div>
                </div>
            </div>

            <!-- Health information -->
            <div class="bg-white dark:bg-[#242526] rounded-lg border border-gray-200 dark:border-gray-700 p-5">
                <h3 class="text-[17px] font-bold text-gray-900 dark:text-gray-100 mb-4">{{ __('Health information') }}</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Height (cm)') }}</label>
                        <flux:input wire:model="height" type="number" placeholder="152" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Weight (kg)') }}</label>
                        <flux:input wire:model="weight" type="number" placeholder="52" />
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Activity level') }}</label>
                        <flux:select wire:model="activity_level" placeholder="Select Activity Level">
                            <flux:select.option>Sedentary</flux:select.option>
                            <flux:select.option>Lightly Active</flux:select.option>
                            <flux:select.option>Moderately Active</flux:select.option>
                            <flux:select.option>Very Active</flux:select.option>
                            <flux:select.option>Extra Active</flux:select.option>
                        </flux:select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Health goals') }}</label>
                        <flux:select wire:model="health_goals" placeholder="Select Health Goal">
                            <flux:select.option>Weight Loss</flux:select.option>
                            <flux:select.option>Muscle Gain</flux:select.option>
                            <flux:select.option>Maintenance</flux:select.option>
                            <flux:select.option>General Fitness</flux:select.option>
                        </flux:select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-1.5">{{ __('Dietary preferences') }}</label>
                        <flux:select wire:model="dietary_preferences" placeholder="Select Preferences">
                            <flux:select.option>Vegetarian</flux:select.option>
                            <flux:select.option>Gluten-Free</flux:select.option>
                            <flux:select.option>Vegan</flux:select.option>
                            <flux:select.option>Dairy-Free</flux:select.option>
                            <flux:select.option>Balanced</flux:select.option>
                            <flux:select.option>Meat-Based</flux:select.option>
                        </flux:select>
                    </div>
                </div>
            </div>

            <!-- Save bar -->
            <div class="sticky bottom-0 bg-white dark:bg-[#242526] rounded-lg border border-gray-200 dark:border-gray-700 p-4 flex items-center gap-4">
                <flux:button variant="primary" type="submit" class="px-6 py-2.5 rounded-md font-semibold bg-blue-600 hover:bg-blue-700">
                    {{ __('Save changes') }}
                </flux:button>
                <x-action-message class="flex items-center gap-2 text-sm text-green-600 dark:text-green-400 font-semibold" on="profile-updated">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ __('Saved successfully') }}
                </x-action-message>
            </div>
        </form>

        <div class="mt-4">
            <livewire:settings.delete-user-form />
        </div>
    </x-settings.layout>
</section>
