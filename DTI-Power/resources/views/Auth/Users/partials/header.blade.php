<header class="sticky shadow-md top-0 z-50 bg-white">
    <nav class=" h-20 px-4 lg:px-10 py-5 dark:bg-gray-800">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-1xl">
            <a href="#" class="flex items-center">
                <img src="/images/DTI_w12.png" class="mr-3 h-6 sm:h-10" alt="DTI Wellness" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white hidden lg:block md:hidden">Wellness Portal</span>
            </a>
            <div class="flex items-center lg:order-2">
                {{-- <button data-modal-target="default-modal" data-modal-toggle="default-modal"  class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">Log in</button> --}}
            @if (Auth::check())
                @if (Auth::user()->role == 'admin')
                    <a href="{{route('dashboard')}}" class="text-white bg-primary-700 hover:bg-white hover:text-primary-500 transition-all duration-300 hover:shadow-lg shadow-primary-500/50 hover:-translate-y-0.5 focus:ring-4 hover:ring-1 hover:ring-primary-500 focus:ring-primary-600 font-medium rounded-full text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-gray-800 focus:outline-none dark:focus:ring-primary-800">Dashboard</a>
                @elseif (Auth::User()->role == 'user')
                <div class="relative inline-block text-left">
    <!-- Trigger Button -->
                <button id="userMenuButton" data-dropdown-toggle="userDropdown" class="flex items-center cursor-pointer space-x-2 focus:outline-none">

                    @if (auth()->user()->profileimage)
                        <img
                            src="{{ asset('storage/' . auth()->user()->profileimage) }}"
                            alt="Current Profile"
                            class="w-[36px] h-[36px] rounded-full object-cover border border-gray-300 dark:border-gray-700"
                        >
                    @else
                        <img
                            src="{{ asset('images/default.png') }}"
                            alt="Default Profile"
                            class="w-[36px] h-[36px] rounded-full object-cover border border-gray-300 dark:border-gray-700"
                        >
                    @endif
                </button>
                <!-- Dropdown Menu -->
                <div id="userDropdown" class="hidden z-50 absolute right-0 mt-2 w-48 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 dark:divide-gray-600">
                    <div class="px-4 py-3 text-sm text-gray-900 dark:text-white">
                        <div class="font-medium truncate">{{ Auth::user()->email }}</div>
                    </div>
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="userMenuButton">
                        <li>
                            <a href="{{Route('settings.profile')}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Account Settings</a>
                        </li>
                    </ul>
                    <div class="py-2">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-red-400 dark:hover:text-white">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>

                {{-- <a href="{{route('user.dashboard')}}" class="text-white bg-primary-700 hover:bg-white hover:text-primary-500 transition-all duration-300 hover:shadow-lg shadow-primary-500/50 hover:-translate-y-0.5 focus:ring-4 hover:ring-1 hover:ring-primary-500 focus:ring-primary-600 font-medium rounded-full text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-gray-800 focus:outline-none dark:focus:ring-primary-800">Dashboard</a> --}}

                {{-- <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="text-white bg-primary-700 hover:bg-white hover:text-primary-500 transition-all duration-300 hover:shadow-lg shadow-primary-500/50 hover:-translate-y-0.5 focus:ring-4 hover:ring-1 hover:ring-primary-500 focus:ring-primary-600 font-medium rounded-full text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        Log out
                    </button>
                </form> --}}
                @endif
                @else
                    <a href="{{route('login')}}" class="text-white bg-primary-700 hover:bg-white hover:text-primary-500 transition-all duration-300 hover:shadow-lg shadow-primary-500/50 hover:-translate-y-0.5 focus:ring-4 hover:ring-1 hover:ring-primary-500 focus:ring-primary-600 font-medium rounded-full text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-gray-800 focus:outline-none dark:focus:ring-primary-800">Get Started</a>
            @endif
                <flux:button x-data x-on:click="$flux.dark = ! $flux.dark" icon="moon" variant="subtle" aria-label="Toggle dark mode" />
                <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                    <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                </button>
            </div>
            <div class="hidden  justify-between items-center w-full bg-gray-50 dark:bg-gray-800 shadow-2xl shadow-accent-foreground rounded-2xl lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex flex-col mt-4 font-medium lg:flex-row bg-white dark:bg-gray-800 lg:space-x-10 lg:mt-0">
                    <li>
                            <a href="{{ route('index') }}"
                            class="@if(request()->routeIs('index'))
                                flex items-center gap-2 text-primary-700 font-semibold dark:text-lime-500 bg-primary-200 p-2 lg:bg-white lg:dark:bg-gray-800 lg:p-0
                            @else
                                flex items-center gap-2 text-gray-800 lg:bg-white dark:text-white lg:text-primary-700 dark:text-white dark:text-lime-500 p-2 lg:bg-white lg:dark:bg-gray-800 lg:p-0
                            @endif">
                                <svg class="w-[30px] h-[30px] text-current" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd" d="M11.293 3.293a1 1 0 0 1 1.414 0l6 6 2 2a1 1 0 0 1-1.414 1.414L19 12.414V19a2 2 0 0 1-2 2h-3a1 1 0 0 1-1-1v-3h-2v3a1 1 0 0 1-1 1H7a2 2 0 0 1-2-2v-6.586l-.293.293a1 1 0 0 1-1.414-1.414l2-2 6-6Z" clip-rule="evenodd"/>
                                </svg>
                                        <span class="relative group text-sm">
                                            Home
                                            <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-current transition-all duration-300 group-hover:w-full"></span>
                                        </span>
                            </a>
                        </li>
                        <li>
                        <a href="{{ route('journal') }}"
                            class="@if(request()->routeIs('journal'))
                                flex items-center gap-2 text-primary-700 font-semibold dark:text-lime-500 bg-primary-200 p-2 lg:bg-white lg:dark:bg-gray-800 lg:p-0
                            @else
                                flex items-center gap-2 text-gray-800 lg:bg-white dark:text-white lg:text-primary-700 dark:text-white dark:text-lime-500 p-2 lg:bg-white lg:dark:bg-gray-800 lg:p-0
                            @endif">
                            <!-- Book Icon -->
                            <svg class="w-[30px] h-[30px] text-current" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd"
                                    d="M6 2a2 2 0 0 0-2 2v15a3 3 0 0 0 3 3h12a1 1 0 1 0 0-2h-2v-2h2a1 1 0 0 0 1-1V4a2 2 0 0 0-2-2h-8v16h5v2H7a1 1 0 1 1 0-2h1V2H6Z"
                                    clip-rule="evenodd" />
                            </svg>

                            <!-- Underline animation only on text -->
                            <span class="relative group text-sm">
                                Journal
                                <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-current transition-all duration-300 group-hover:w-full"></span>
                            </span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('nutrition') }}"
                            class="@if(request()->routeIs('nutrition'))
                                flex items-center gap-2 text-primary-700 font-semibold dark:text-lime-500 bg-primary-200 p-2 lg:bg-white lg:dark:bg-gray-800 lg:p-0
                            @else
                                flex items-center gap-2 text-gray-800 lg:bg-white dark:text-white lg:text-primary-700 dark:text-white dark:text-lime-500 p-2 lg:bg-white lg:dark:bg-gray-800 lg:p-0
                            @endif">
                                <svg class="w-[30px] h-[30px] text-current" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                                <path fill="currentColor" d="M10.9715 12.2168c-.0118.0406-.0234.0795-.0347.1166.0391.0574.0819.1192.1278.1855.3277.473.812 1.172 1.2141 2.0892.2147-.2864.4616-.5799.7447-.8832l-.0024-.0317c-.0236-.3254-.0361-.7783.0091-1.2905.0882-.9978.4095-2.3695 1.4623-3.39555 1.0079-.98229 2.3556-1.42385 3.4044-1.59916.5344-.08932 1.0323-.11665 1.4296-.09869.1954.00883.3932.02974.5707.07034.0872.01996.1979.05097.3114.10232.0867.03927.3102.14854.4769.39195.1453.21217.1993.45929.22.55586.0321.14963.0559.32134.0712.50398.0307.36676.0311.82807-.0291 1.32915-.1181.9828-.4871 2.2522-1.47 3.2102-1.0357 1.0093-2.4736 1.3803-3.5197 1.5249-.542.0749-1.0253.0952-1.3736.0969-.036.0002-.0706.0002-.1037 0-.931.9987-1.2688 1.7317-1.4072 2.3512-.0345.1545-.0581.303-.0739.451.0004.0342.0006.0685.0006.1029v2c0 .5523-.4477 1-1 1s-1-.4477-1-1c0-.1991-.0064-.4114-.0131-.6334-.0142-.4713-.0298-.9868.0117-1.5138-.0358-1.8786-.7555-2.9405-1.40123-3.8932-.13809-.2037-.2728-.4025-.39671-.6032-.05186-.0105-.10709-.0222-.16538-.035-.39471-.0865-.93803-.2268-1.53416-.4432-1.15636-.4197-2.67587-1.1841-3.58743-2.5531-.90552-1.35993-1.03979-2.96316-.96002-4.15955.04066-.60984.13916-1.15131.24451-1.56046.05234-.20327.10977-.38715.16845-.53804.02865-.07367.06419-.15663.10713-.23658.02132-.03968.0522-.09319.0933-.15021.03213-.04456.11389-.15344.24994-.25057.18341-.13093.36351-.16755.42749-.17932.0854-.01572.16019-.01941.21059-.02024.1023-.0017.20235.00733.28493.0176.17089.02126.37298.06155.58906.11526.43651.1085.99747.2886 1.59668.54576 1.16944.50188 2.63819 1.3629 3.52935 2.70126.9248 1.38891.9601 2.99601.818 4.14739-.0726.589-.1962 1.0975-.3016 1.4594Z"/>
                                </svg>
                                <span class="relative group text-sm">
                                            Nutrition
                                            <span class="absolute left-0 -bottom-1 w-0 h-[2px] bg-current transition-all duration-300 group-hover:w-full"></span>
                                        </span>
                            </a>
                        </li>
                        <li>
                            <a href="#" class="flex items-center gap-2 py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white" aria-current="page">
                                <!-- Health Quiz Icon -->
                                <svg class="w-[30px] h-[30px] text-current" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                                <path fill-rule="evenodd" d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm9.008-3.018a1.502 1.502 0 0 1 2.522 1.159v.024a1.44 1.44 0 0 1-1.493 1.418 1 1 0 0 0-1.037.999V14a1 1 0 1 0 2 0v-.539a3.44 3.44 0 0 0 2.529-3.256 3.502 3.502 0 0 0-7-.255 1 1 0 0 0 2 .076c.014-.398.187-.774.48-1.044Zm.982 7.026a1 1 0 1 0 0 2H12a1 1 0 1 0 0-2h-.01Z" clip-rule="evenodd"/>
                                </svg>

                                <span class="text-sm font-sm">Health Quiz</span>
                            </a>
                        </li>
                        <button id="dropdownNavbarLink" data-dropdown-toggle="dropdownNavbar" class="flex cursor-pointer items-center gap-2 py-2 pr-4 pl-3 text-white rounded bg-primary-700 lg:bg-transparent lg:text-primary-700 lg:p-0 dark:text-white">
                            <svg class="w-[30px] h-[30px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linejoin="round" stroke-width="1.2" d="M7.58209 8.96025 9.8136 11.1917l-1.61782 1.6178c-1.08305-.1811-2.23623.1454-3.07364.9828-1.1208 1.1208-1.32697 2.8069-.62368 4.1363.14842.2806.42122.474.73509.5213.06726.0101.1347.0133.20136.0098-.00351.0666-.00036.1341.00977.2013.04724.3139.24069.5867.52125.7351 1.32944.7033 3.01552.4971 4.13627-.6237.8375-.8374 1.1639-1.9906.9829-3.0736l4.8107-4.8108c1.0831.1811 2.2363-.1454 3.0737-.9828 1.1208-1.1208 1.3269-2.80688.6237-4.13632-.1485-.28056-.4213-.474-.7351-.52125-.0673-.01012-.1347-.01327-.2014-.00977.0035-.06666.0004-.13409-.0098-.20136-.0472-.31386-.2406-.58666-.5212-.73508-1.3294-.70329-3.0155-.49713-4.1363.62367-.8374.83741-1.1639 1.9906-.9828 3.07365l-1.7788 1.77875-2.23152-2.23148-1.41419 1.41424Zm1.31056-3.1394c-.04235-.32684-.24303-.61183-.53647-.76186l-1.98183-1.0133c-.38619-.19746-.85564-.12345-1.16234.18326l-.86321.8632c-.3067.3067-.38072.77616-.18326 1.16235l1.0133 1.98182c.15004.29345.43503.49412.76187.53647l1.1127.14418c.3076.03985.61628-.06528.8356-.28461l.86321-.8632c.21932-.21932.32446-.52801.2846-.83561l-.14417-1.1127ZM19.4448 16.4052l-3.1186-3.1187c-.7811-.781-2.0474-.781-2.8285 0l-.1719.172c-.7811.781-.7811 2.0474 0 2.8284l3.1186 3.1187c.7811.781 2.0474.781 2.8285 0l.1719-.172c.7811-.781.7811-2.0474 0-2.8284Z"/>
                            </svg>
                            <span class="text-sm font-sm">Tools</span>

                            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>

                <!-- Dropdown menu -->
                        <div id="dropdownNavbar" class="z-10 hidden font-normal bg-white divide-y divide-gray-100 rounded-lg shadow-sm w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownLargeButton">
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Physical Tools</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Mental tools</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Emotional tools</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Financial tools</a>
                                </li>
                                <li>
                                    <a href="#" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Social tools</a>
                                </li>
                                </ul>
                        </div>
                </ul>
            </div>
        </div>
    </nav>
</header>
