import "../../node_modules/flowbite/dist/flowbite.min.js";
import "../../node_modules/apexcharts/dist/apexcharts.min.js";
import 'flowbite';



var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');

// Change the icons inside the button based on previous settings
if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
    themeToggleLightIcon.classList.remove('hidden');
} else {
    themeToggleDarkIcon.classList.remove('hidden');
}

var themeToggleBtn = document.getElementById('theme-toggle');

themeToggleBtn.addEventListener('click', function() {

    // toggle icons inside button
    themeToggleDarkIcon.classList.toggle('hidden');
    themeToggleLightIcon.classList.toggle('hidden');

    // if set via local storage previously
    if (localStorage.getItem('color-theme')) {
        if (localStorage.getItem('color-theme') === 'light') {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        } else {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        }

    // if NOT set via local storage previously
    } else {
        if (document.documentElement.classList.contains('dark')) {
            document.documentElement.classList.remove('dark');
            localStorage.setItem('color-theme', 'light');
        } else {
            document.documentElement.classList.add('dark');
            localStorage.setItem('color-theme', 'dark');
        }
    }

});

const scrollContainer = document.getElementById("scrollContainer");
  const scrollLeft = document.getElementById("scrollLeft");
  const scrollRight = document.getElementById("scrollRight");

  scrollLeft.addEventListener("click", () => {
    scrollContainer.scrollBy({ left: -200, behavior: "smooth" });
  });

  scrollRight.addEventListener("click", () => {
    scrollContainer.scrollBy({ left: 200, behavior: "smooth" });
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

