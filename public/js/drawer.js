document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('mobile-sidebar');
    const sidebarContent = document.getElementById('mobile-sidebar-content');
    const backdrop = document.getElementById('mobile-sidebar-backdrop');
    const toggleBtn = document.getElementById('mobile-sidebar-toggle');
    const closeBtn = document.getElementById('mobile-sidebar-close');

    function openSidebar() {
        sidebar.classList.remove('hidden');
        setTimeout(() => {
            sidebarContent.classList.remove('-translate-x-full');
        }, 10);
    }

    function closeSidebar() {
        sidebarContent.classList.add('-translate-x-full');
        setTimeout(() => {
            sidebar.classList.add('hidden');
        }, 300);
    }

    // Open sidebar
    toggleBtn.addEventListener('click', openSidebar);

    // Close sidebar
    closeBtn.addEventListener('click', closeSidebar);
    backdrop.addEventListener('click', closeSidebar);

    // Close on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && !sidebar.classList.contains('hidden')) {
            closeSidebar();
        }
    });

    // Dropdowns: Games & Quizzes
    const ddGamesToggle = document.getElementById('mobile-dd-games-toggle');
    const ddGames = document.getElementById('mobile-dd-games');
    const ddGamesArrow = document.getElementById('mobile-dd-games-arrow');
    if (ddGamesToggle && ddGames && ddGamesArrow) {
        ddGamesToggle.addEventListener('click', function () {
            ddGames.classList.toggle('hidden');
            ddGamesArrow.classList.toggle('rotate-180');
        });
    }

    // Dropdowns: Well-being Tools
    const ddToolsToggle = document.getElementById('mobile-dd-tools-toggle');
    const ddTools = document.getElementById('mobile-dd-tools');
    const ddToolsArrow = document.getElementById('mobile-dd-tools-arrow');
    if (ddToolsToggle && ddTools && ddToolsArrow) {
        ddToolsToggle.addEventListener('click', function () {
            ddTools.classList.toggle('hidden');
            ddToolsArrow.classList.toggle('rotate-180');
        });
    }
});