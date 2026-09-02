import "../../node_modules/flowbite/dist/flowbite.min.js";
import "../../node_modules/apexcharts/dist/apexcharts.min.js";
import 'flowbite';



const themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
const themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
const themeToggleBtn = document.getElementById('theme-toggle');

const setTheme = (isDark) => {
    document.documentElement.classList.toggle('dark', isDark);
    localStorage.setItem('color-theme', isDark ? 'dark' : 'light');

    themeToggleDarkIcon?.classList.toggle('hidden', isDark);
    themeToggleLightIcon?.classList.toggle('hidden', !isDark);
    themeToggleBtn?.setAttribute('aria-label', isDark ? 'Switch to light mode' : 'Switch to dark mode');
};

const savedTheme = localStorage.getItem('color-theme');
const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
setTheme(savedTheme ? savedTheme === 'dark' : prefersDark);

themeToggleBtn?.addEventListener('click', () => {
    setTheme(!document.documentElement.classList.contains('dark'));
});

const scrollContainer = document.getElementById("scrollContainer");
  const scrollLeft = document.getElementById("scrollLeft");
  const scrollRight = document.getElementById("scrollRight");

    scrollLeft?.addEventListener("click", () => {
    scrollContainer?.scrollBy({ left: -200, behavior: "smooth" });
  });

    scrollRight?.addEventListener("click", () => {
    scrollContainer?.scrollBy({ left: 200, behavior: "smooth" });
  });

// Laravel Echo (Pusher) - enable realtime notifications if env keys are present
try {
    const pusherKey = import.meta.env.VITE_PUSHER_APP_KEY;
    const pusherCluster = import.meta.env.VITE_PUSHER_APP_CLUSTER || 'mt1';
    if (pusherKey) {
        import('pusher-js').then(({ default: Pusher }) => {
            import('laravel-echo').then(({ default: Echo }) => {
                window.Pusher = Pusher;
                window.Echo = new Echo({
                    broadcaster: 'pusher',
                    key: pusherKey,
                    cluster: pusherCluster,
                    wsHost: import.meta.env.VITE_PUSHER_HOST || `ws-${pusherCluster}.pusher.com`,
                    wsPort: Number(import.meta.env.VITE_PUSHER_PORT || 80),
                    wssPort: Number(import.meta.env.VITE_PUSHER_PORT || 443),
                    forceTLS: (import.meta.env.VITE_PUSHER_SCHEME || 'https') === 'https',
                    enabledTransports: ['ws', 'wss'],
                    disableStats: true,
                    authEndpoint: '/broadcasting/auth',
                    auth: {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    }
                });
            });
        });
    }
} catch (e) {
    // Echo not initialized; fall back to Livewire polling
}

