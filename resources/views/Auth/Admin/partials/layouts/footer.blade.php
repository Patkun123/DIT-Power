<footer class="bg-white rounded-lg shadow sm:flex sm:items-center sm:justify-between p-4 sm:p-6 xl:p-8 dark:bg-gray-800 antialiased">
  <div class="max-w-screen-xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 items-start">
      <!-- Brand -->
      <div class="flex items-center space-x-3">
        <img src="/images/DTI_w12.png" alt="DTI" class="h-8 w-auto" />
        <div>
          <p class="text-sm font-semibold text-gray-900 dark:text-gray-100">DIT-Power Admin</p>
          <p class="text-xs text-gray-500 dark:text-gray-400">Personalized Online Wellness Resource HUB</p>
        </div>
      </div>

      <!-- Quick links -->
      <div class="flex flex-wrap md:justify-center gap-x-6 gap-y-2 text-sm">
        <a href="{{ route('dashboard') }}" class="text-gray-600 hover:text-primary-600 dark:text-gray-300 dark:hover:text-primary-400 transition">Dashboard</a>
        <a href="{{ route('manage.user') }}" class="text-gray-600 hover:text-primary-600 dark:text-gray-300 dark:hover:text-primary-400 transition">Manage Users</a>
        <a href="{{ route('article') }}" class="text-gray-600 hover:text-primary-600 dark:text-gray-300 dark:hover:text-primary-400 transition">Articles & News</a>
        <a href="{{ route('admin.feedbacks.index') }}" class="text-gray-600 hover:text-primary-600 dark:text-gray-300 dark:hover:text-primary-400 transition">Feedbacks</a>
        <a href="{{ route('leaderboards') }}" class="text-gray-600 hover:text-primary-600 dark:text-gray-300 dark:hover:text-primary-400 transition">Leaderboards</a>
      </div>

      <!-- Status / Social -->
      <div class="flex md:justify-end items-center gap-4">
        <div class="text-right">
          <p class="text-xs text-gray-500 dark:text-gray-400">{{ config('app.name') }} • {{ strtoupper(app()->environment()) }}</p>
          <p class="text-xs text-gray-500 dark:text-gray-400">© {{ now()->year }} DIT Region 12. All rights reserved.</p>
        </div>
        <div class="hidden sm:flex items-center gap-2">
          <a href="#" class="p-2 rounded-lg text-gray-500 hover:text-gray-900 hover:bg-gray-100 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-700 transition" aria-label="GitHub">
            <svg class="w-4 h-4" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 .333A9.911 9.911 0 0 0 6.866 19.65c.5.092.678-.215.678-.477 0-.237-.01-1.017-.014-1.845-2.757.6-3.338-1.169-3.338-1.169a2.627 2.627 0 0 0-1.1-1.451c-.9-.615.07-.6.07-.6a2.084 2.084 0 0 1 1.518 1.021 2.11 2.11 0 0 0 2.884.823c.044-.503.268-.973.63-1.325-2.2-.25-4.516-1.1-4.516-4.9A3.832 3.832 0 0 1 4.7 7.068a3.56 3.56 0 0 1 .095-2.623s.832-.266 2.726 1.016a9.409 9.409 0 0 1 4.962 0c1.89-1.282 2.717-1.016 2.717-1.016.366.83.402 1.768.1 2.623a3.827 3.827 0 0 1 1.02 2.659c0 3.807-2.319 4.644-4.525 4.889a2.366 2.366 0 0 1 .673 1.834c0 1.326-.012 2.394-.012 2.72 0 .263.18.572.681.475A9.911 9.911 0 0 0 10 .333Z" clip-rule="evenodd"/></svg>
          </a>
        </div>
      </div>
    </div>
  </div>
</footer>
