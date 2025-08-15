<div class="relative p-5 mb-6 w-full bg-gray-100 dark:bg-gray-800 flex items-center">
    <!-- Back button -->
    <a href="{{ route('index')}}"
       class="flex items-center text-sm text-white bg-red-600 hover:bg-red-700 px-3 py-1 rounded-md mr-4">
        ← Back
    </a>
    <div>
        <flux:heading size="xl" level="1">{{ __('Settings') }}</flux:heading>
        <flux:subheading size="lg" class="mb-6">
            {{ __('Manage your profile and account settings') }}
        </flux:subheading>
    </div>
</div>
<flux:separator variant="subtle" />
