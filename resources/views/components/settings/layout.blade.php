<div class="w-full min-h-screen">

    <div class="grid grid-cols-1 md:grid-cols-12 gap-4 sm:gap-6 lg:gap-8
                px-3 sm:px-4 md:px-6 lg:px-8 xl:px-12
                py-4 sm:py-6 lg:py-10">

        {{-- =========================================================
            DESKTOP SIDEBAR
        ========================================================== --}}
        <aside class="hidden md:block md:col-span-3 lg:col-span-3 xl:col-span-2">
            <div class="sticky top-24 lg:top-32">

                <div class="bg-white dark:bg-gray-800
                            rounded-2xl lg:rounded-3xl
                            border border-gray-200/60 dark:border-gray-700/60
                            shadow-lg hover:shadow-xl
                            transition-all duration-300
                            p-4 lg:p-6 xl:p-7">

                    <div class="mb-5 lg:mb-6">
                        <div class="flex items-center gap-3 px-1">
                            <div class="p-2 rounded-xl
                                        bg-gradient-to-br from-primary-500 to-primary-600
                                        dark:from-primary-600 dark:to-primary-700
                                        shadow-lg">

                                <svg class="w-5 h-5 text-white"
                                     fill="none"
                                     stroke="currentColor"
                                     viewBox="0 0 24 24">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-1.543 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>

                            </div>

                            <h3 class="text-xs font-bold
                                       text-gray-500 dark:text-gray-400
                                       uppercase tracking-widest">
                                Settings
                            </h3>
                        </div>
                    </div>

                    <nav class="space-y-2">

                        {{-- Profile --}}
                        <a href="{{ route('settings.profile') }}"
                           wire:navigate
                           class="flex items-center gap-3
                                  px-3.5 lg:px-4
                                  py-3 lg:py-3.5
                                  rounded-xl lg:rounded-2xl
                                  transition-all duration-200
                                  group
                                  {{ request()->routeIs('settings.profile')
                                      ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white font-semibold shadow-lg shadow-primary-500/30'
                                      : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">

                            <svg class="w-5 h-5 flex-shrink-0"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>

                            <span class="text-sm font-semibold">
                                {{ __('Profile') }}
                            </span>
                        </a>

                        {{-- Password --}}
                        <a href="{{ route('settings.password') }}"
                           wire:navigate
                           class="flex items-center gap-3
                                  px-3.5 lg:px-4
                                  py-3 lg:py-3.5
                                  rounded-xl lg:rounded-2xl
                                  transition-all duration-200
                                  group
                                  {{ request()->routeIs('settings.password')
                                      ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white font-semibold shadow-lg shadow-primary-500/30'
                                      : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">

                            <svg class="w-5 h-5 flex-shrink-0"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>

                            <span class="text-sm font-semibold">
                                {{ __('Password') }}
                            </span>
                        </a>

                        {{-- Appearance --}}
                        <a href="{{ route('settings.appearance') }}"
                           wire:navigate
                           class="flex items-center gap-3
                                  px-3.5 lg:px-4
                                  py-3 lg:py-3.5
                                  rounded-xl lg:rounded-2xl
                                  transition-all duration-200
                                  group
                                  {{ request()->routeIs('settings.appearance')
                                      ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white font-semibold shadow-lg shadow-primary-500/30'
                                      : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700/50' }}">

                            <svg class="w-5 h-5 flex-shrink-0"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                            </svg>

                            <span class="text-sm font-semibold">
                                {{ __('Appearance') }}
                            </span>
                        </a>

                    </nav>
                </div>
            </div>
        </aside>


        {{-- =========================================================
            MAIN CONTENT
        ========================================================== --}}
        <main class="md:col-span-9 lg:col-span-9 xl:col-span-10 min-w-0">

            {{-- Top Mobile Controls --}}
            <div class="flex items-center justify-between gap-3 mb-5 md:hidden">

                {{-- Back --}}
                <a href="{{ route('index') }}"
                   class="inline-flex items-center justify-center
                          w-10 h-10
                          shrink-0
                          rounded-full
                          bg-gray-100 dark:bg-gray-800
                          hover:bg-gray-200 dark:hover:bg-gray-700
                          transition-colors duration-200">

                    <svg class="w-5 h-5 text-gray-700 dark:text-gray-300"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M15 19l-7-7 7-7"/>
                    </svg>

                </a>

                {{-- Mobile Settings Button --}}
                <button id="settings-mobile-open"
                        type="button"
                        class="inline-flex items-center gap-2
                               min-h-10
                               px-4
                               rounded-full
                               bg-gray-100 dark:bg-gray-800
                               text-gray-700 dark:text-gray-200
                               text-sm font-semibold
                               hover:bg-gray-200 dark:hover:bg-gray-700
                               transition-all duration-200">

                    <svg class="w-4 h-4"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-.94-1.543-.94-1.543-2.37-2.37"/>
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>

                    Settings
                </button>
            </div>


            {{-- Desktop Back Button --}}
            <div class="hidden md:block mb-6">
                <a href="{{ route('index') }}"
                   class="inline-flex items-center justify-center
                          w-10 h-10
                          rounded-full
                          bg-gray-100 dark:bg-gray-800
                          hover:bg-gray-200 dark:hover:bg-gray-700
                          transition-colors duration-200">

                    <svg class="w-5 h-5 text-gray-700 dark:text-gray-300"
                         fill="none"
                         stroke="currentColor"
                         viewBox="0 0 24 24">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M15 19l-7-7 7-7"/>
                    </svg>

                </a>
            </div>


            {{-- Heading --}}
            <div class="mb-6 sm:mb-8 md:mb-10 lg:mb-12">

                <div class="flex items-start sm:items-center gap-3 sm:gap-5">

                    <div class="hidden sm:flex
                                p-3 sm:p-4
                                shrink-0
                                rounded-xl sm:rounded-2xl
                                bg-gradient-to-br from-primary-500 to-primary-600
                                dark:from-primary-600 dark:to-primary-700
                                shadow-xl shadow-primary-500/20">

                        <svg class="w-5 h-5 sm:w-7 sm:h-7 text-white"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>

                    </div>

                    <div class="min-w-0">

                        <flux:heading
                            class="text-2xl sm:text-3xl lg:text-4xl
                                   font-bold
                                   leading-tight
                                   bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900
                                   dark:from-gray-100 dark:via-gray-200 dark:to-gray-100
                                   bg-clip-text text-transparent">

                            {{ $heading ?? '' }}

                        </flux:heading>

                        <flux:subheading
                            class="text-sm sm:text-base lg:text-lg
                                   mt-1.5 sm:mt-2.5
                                   text-gray-600 dark:text-gray-400
                                   font-medium
                                   leading-relaxed">

                            {{ $subheading ?? '' }}

                        </flux:subheading>

                    </div>
                </div>
            </div>


            {{-- Page Content --}}
            <div class="w-full max-w-5xl xl:max-w-6xl min-w-0">
                {{ $slot }}
            </div>

        </main>
    </div>


    {{-- =========================================================
        MOBILE DRAWER
    ========================================================== --}}
    <div id="settings-mobile-drawer"
         class="fixed inset-0 z-[60] hidden md:hidden"
         aria-hidden="true">

        {{-- Backdrop --}}
        <div id="settings-mobile-backdrop"
             class="absolute inset-0
                    bg-black/50
                    backdrop-blur-sm
                    opacity-0
                    transition-opacity duration-300">
        </div>


        {{-- Drawer --}}
        <div id="settings-mobile-panel"
             class="absolute left-0 top-0
                    h-full
                    w-[85%] max-w-sm
                    bg-white dark:bg-gray-900
                    shadow-2xl
                    transform -translate-x-full
                    transition-transform duration-300 ease-out
                    flex flex-col">

            {{-- Drawer Header --}}
            <div class="shrink-0
                        p-5
                        border-b border-gray-200 dark:border-gray-700
                        bg-gradient-to-br
                        from-primary-500/10
                        via-primary-50
                        to-white
                        dark:from-primary-900/30
                        dark:via-gray-900
                        dark:to-gray-950">

                <div class="flex items-center justify-between gap-3">

                    <div class="flex items-center gap-3">

                        <div class="p-2.5 rounded-xl
                                    bg-gradient-to-br from-primary-500 to-primary-600
                                    dark:from-primary-600 dark:to-primary-700
                                    shadow-lg">

                            <svg class="w-5 h-5 text-white"
                                 fill="none"
                                 stroke="currentColor"
                                 viewBox="0 0 24 24">

                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 1.543-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-.94-1.543-.94-1.543-2.37-2.37"/>
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      stroke-width="2"
                                      d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>

                        </div>

                        <div class="min-w-0">

                            <div class="text-base font-bold
                                        text-gray-800 dark:text-gray-100">
                                Settings
                            </div>

                            <div class="text-xs
                                        text-gray-500 dark:text-gray-400
                                        font-medium truncate">
                                {{ $heading ?? '' }}
                            </div>

                        </div>

                    </div>


                    <button id="settings-mobile-close"
                            type="button"
                            class="shrink-0
                                   p-2.5
                                   rounded-xl
                                   hover:bg-gray-100 dark:hover:bg-gray-800
                                   transition-colors
                                   border border-gray-200 dark:border-gray-700">

                        <svg class="w-5 h-5
                                    text-gray-600 dark:text-gray-300"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>

                    </button>
                </div>
            </div>


            {{-- Drawer Navigation --}}
            <div class="flex-1 overflow-y-auto p-4">

                <nav class="space-y-2">

                    <a href="{{ route('settings.profile') }}"
                       wire:navigate
                       class="flex items-center gap-3
                              px-4 py-3.5
                              rounded-xl
                              transition-all
                              {{ request()->routeIs('settings.profile')
                                  ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white font-semibold shadow-lg shadow-primary-500/30'
                                  : 'text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800' }}">

                        <svg class="w-5 h-5 shrink-0"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>

                        <span class="text-sm font-semibold">
                            {{ __('Profile') }}
                        </span>
                    </a>


                    <a href="{{ route('settings.password') }}"
                       wire:navigate
                       class="flex items-center gap-3
                              px-4 py-3.5
                              rounded-xl
                              transition-all
                              {{ request()->routeIs('settings.password')
                                  ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white font-semibold shadow-lg shadow-primary-500/30'
                                  : 'text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800' }}">

                        <svg class="w-5 h-5 shrink-0"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>

                        <span class="text-sm font-semibold">
                            {{ __('Password') }}
                        </span>
                    </a>


                    <a href="{{ route('settings.appearance') }}"
                       wire:navigate
                       class="flex items-center gap-3
                              px-4 py-3.5
                              rounded-xl
                              transition-all
                              {{ request()->routeIs('settings.appearance')
                                  ? 'bg-gradient-to-r from-primary-500 to-primary-600 text-white font-semibold shadow-lg shadow-primary-500/30'
                                  : 'text-gray-700 dark:text-gray-300 border border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800' }}">

                        <svg class="w-5 h-5 shrink-0"
                             fill="none"
                             stroke="currentColor"
                             viewBox="0 0 24 24">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
                        </svg>

                        <span class="text-sm font-semibold">
                            {{ __('Appearance') }}
                        </span>
                    </a>

                </nav>
            </div>
        </div>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', () => {

    const openBtn = document.getElementById('settings-mobile-open');
    const drawer = document.getElementById('settings-mobile-drawer');
    const panel = document.getElementById('settings-mobile-panel');
    const backdrop = document.getElementById('settings-mobile-backdrop');
    const closeBtn = document.getElementById('settings-mobile-close');

    if (!openBtn || !drawer || !panel || !backdrop || !closeBtn) {
        return;
    }

    function openDrawer() {

        drawer.classList.remove('hidden');
        drawer.setAttribute('aria-hidden', 'false');

        document.body.classList.add('overflow-hidden');

        requestAnimationFrame(() => {
            panel.classList.remove('-translate-x-full');
            backdrop.classList.remove('opacity-0');
        });
    }

    function closeDrawer() {

        panel.classList.add('-translate-x-full');
        backdrop.classList.add('opacity-0');

        drawer.setAttribute('aria-hidden', 'true');
        document.body.classList.remove('overflow-hidden');

        setTimeout(() => {
            drawer.classList.add('hidden');
        }, 300);
    }

    openBtn.addEventListener('click', openDrawer);
    closeBtn.addEventListener('click', closeDrawer);
    backdrop.addEventListener('click', closeDrawer);

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !drawer.classList.contains('hidden')) {
            closeDrawer();
        }
    });

});
</script>
```
