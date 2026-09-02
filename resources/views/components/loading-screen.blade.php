<div id="admin-loading-screen" class="loading-screen" role="status" aria-live="polite" aria-label="Loading admin panel">
	<div class="loading-container loading-content">
		<img src="{{ asset('Images/lightmode.png') }}" alt="DTI Wellness" class="loading-logo logo">
		<p class="loading-title">Loading admin panel</p>
		<div class="progress-bar" role="progressbar" aria-label="Loading" aria-valuemin="0" aria-valuemax="100">
			<span class="progress-fill"></span>
		</div>
		<span class="loading-dots" aria-hidden="true">Please wait</span>
	</div>
</div>

<script>
	(() => {
		const loadingScreen = document.getElementById('admin-loading-screen');

		if (!loadingScreen) {
			return;
		}

		const hideLoadingScreen = () => {
			loadingScreen.classList.add('fade-out');
			loadingScreen.setAttribute('aria-hidden', 'true');
		};

		const showLoadingScreen = () => {
			loadingScreen.classList.remove('fade-out');
			loadingScreen.setAttribute('aria-hidden', 'false');
		};

		window.addEventListener('load', hideLoadingScreen, { once: true });
		document.addEventListener('livewire:navigate', showLoadingScreen);
		document.addEventListener('livewire:navigated', hideLoadingScreen);
		window.setTimeout(hideLoadingScreen, 4000);
	})();
</script>
