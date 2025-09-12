<div class="relative p-4 md:p-5 mb-6 w-full bg-gray-50 dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between">
    <!-- Back button (modern) -->
    <div class="flex items-center gap-3">
        <a href="{{ route('index')}}" class="inline-flex items-center gap-2 px-3 py-2 rounded-full border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="15 18 9 12 15 6"/></svg>
            <span class="text-xs font-medium">Back</span>
        </a>
        <div>
            <flux:heading size="xl" level="1">{{ __('Settings') }}</flux:heading>
        </div>
    </div>

    <!-- Fixed Settings Nav (mobile quick access) -->
    <div class="hidden md:flex items-center gap-2">
        <a href="{{ route('settings.profile') }}" class="px-3 py-2 text-xs rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 {{ request()->routeIs('settings.profile') ? 'bg-gray-100 dark:bg-gray-800 font-semibold' : '' }}">Profile</a>
        <a href="{{ route('settings.password') }}" class="px-3 py-2 text-xs rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 {{ request()->routeIs('settings.password') ? 'bg-gray-100 dark:bg-gray-800 font-semibold' : '' }}">Password</a>
        <a href="{{ route('settings.appearance') }}" class="px-3 py-2 text-xs rounded-lg hover:bg-gray-100 dark:hover:bg-gray-800 {{ request()->routeIs('settings.appearance') ? 'bg-gray-100 dark:bg-gray-800 font-semibold' : '' }}">Appearance</a>
    </div>
</div>
<flux:separator variant="subtle" />
