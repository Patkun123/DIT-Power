<section class="w-full">
    <x-settings.layout :heading="__('My Profile')" :subheading="__('View your profile information')">
        <div class="space-y-6">
            <!-- Profile Header Card -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm overflow-hidden">
                <!-- Profile Picture Section -->
                <div class="bg-gradient-to-br from-primary-500 to-primary-700 p-8 flex flex-col items-center justify-center">
                    <div class="relative">
                        <img
                            src="{{ $user->profileImageUrl }}"
                            alt="{{ $user->firstname }} {{ $user->lastname }}"
                            class="w-32 h-32 rounded-full object-cover border-4 border-white dark:border-gray-800 shadow-lg"
                        >
                    </div>
                    <div class="mt-4 text-center">
                        <h1 class="text-2xl font-bold text-white">
                            {{ $user->firstname }} {{ $user->lastname }}
                        </h1>
                        @if($user->bio)
                            <p class="text-primary-100 mt-2 text-sm">{{ $user->bio }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- About Section -->
            <div class="bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm p-6">
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-100 mb-6 flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    About
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Personal Information -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide mb-4">Personal Information</h3>
                        
                        <div class="space-y-3">
                            <div>
                                <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Email</label>
                                <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $user->email }}</p>
                            </div>

                            @if($userInfo)
                                @if($userInfo->phone_number)
                                    <div>
                                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Phone Number</label>
                                        <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $userInfo->phone_number }}</p>
                                    </div>
                                @endif

                                @if($userInfo->gender)
                                    <div>
                                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Gender</label>
                                        <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $userInfo->gender }}</p>
                                    </div>
                                @endif

                                @if($userInfo->birthday)
                                    <div>
                                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Birthday</label>
                                        <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $userInfo->birthday->format('F d, Y') }}</p>
                                    </div>
                                @endif

                                @if($userInfo->address)
                                    <div>
                                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Address</label>
                                        <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $userInfo->address }}</p>
                                    </div>
                                @endif

                                @if($userInfo->civil_status)
                                    <div>
                                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Civil Status</label>
                                        <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $userInfo->civil_status }}</p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    <!-- Career Information -->
                    <div class="space-y-4">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide mb-4">Career Information</h3>
                        
                        <div class="space-y-3">
                            @if($staffInfo)
                                @if($staffInfo->staff_id)
                                    <div>
                                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">DTI ID Number</label>
                                        <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $staffInfo->staff_id }}</p>
                                    </div>
                                @endif

                                @if($staffInfo->office)
                                    <div>
                                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Office</label>
                                        <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $staffInfo->office }}</p>
                                    </div>
                                @endif

                                @if($staffInfo->position)
                                    <div>
                                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Position</label>
                                        <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $staffInfo->position }}</p>
                                    </div>
                                @endif

                                @if($staffInfo->department)
                                    <div>
                                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Department</label>
                                        <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $staffInfo->department }}</p>
                                    </div>
                                @endif
                            @endif

                            @if($userInfo)
                                @if($userInfo->career)
                                    <div>
                                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Nature of Appointment</label>
                                        <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $userInfo->career }}</p>
                                    </div>
                                @endif

                                @if($userInfo->level_career)
                                    <div>
                                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Level</label>
                                        <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $userInfo->level_career }}</p>
                                    </div>
                                @endif

                                @if($userInfo->years_in_dti)
                                    <div>
                                        <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Years in DTI</label>
                                        <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $userInfo->years_in_dti }}</p>
                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>

                    <!-- Health Information -->
                    @if($userInfo && ($userInfo->height || $userInfo->weight || $userInfo->activity_level || $userInfo->health_goals || $userInfo->dietary_preferences))
                    <div class="space-y-4 md:col-span-2">
                        <h3 class="text-sm font-semibold text-gray-700 dark:text-gray-300 uppercase tracking-wide mb-4">Health Profile</h3>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($userInfo->height)
                                <div>
                                    <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Height</label>
                                    <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $userInfo->height }} cm</p>
                                </div>
                            @endif

                            @if($userInfo->weight)
                                <div>
                                    <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Weight</label>
                                    <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $userInfo->weight }} kg</p>
                                </div>
                            @endif

                            @if($userInfo->activity_level)
                                <div>
                                    <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Activity Level</label>
                                    <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $userInfo->activity_level }}</p>
                                </div>
                            @endif

                            @if($userInfo->health_goals)
                                <div>
                                    <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Health Goals</label>
                                    <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $userInfo->health_goals }}</p>
                                </div>
                            @endif

                            @if($userInfo->dietary_preferences)
                                <div class="md:col-span-2">
                                    <label class="text-xs font-medium text-gray-500 dark:text-gray-400">Dietary Preferences</label>
                                    <p class="text-sm text-gray-800 dark:text-gray-200 mt-1">{{ $userInfo->dietary_preferences }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Edit Profile Button -->
                <div class="mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                    <a href="{{ route('settings.profile') }}" class="inline-flex items-center gap-2 px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </x-settings.layout>
</section>
