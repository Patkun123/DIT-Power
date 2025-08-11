<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Profile')" :subheading="__('Update your name and email address')">
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">

                    @if (auth()->user()->profileimage)
                        <img
                            src="{{ asset('storage/' . auth()->user()->profileimage) }}"
                            alt="Current Profile"
                            class="w-24 h-24 rounded-full object-cover border border-gray-300 dark:border-gray-700"
                        >
                    @else
                        <img
                            src="{{ asset('images/default.png') }}"
                            alt="Default Profile"
                            class="w-24 h-24 rounded-full object-cover border border-gray-300 dark:border-gray-700"
                        >
                    @endif
            <!-- 2-column layout for inputs -->
            <div class="grid grid-cols-2 md:grid-cols-2 gap-6">
                <flux:input wire:model="firstname" :label="__('First name')" type="text" required autofocus autocomplete="firstname" />
                <flux:input wire:model="lastname" :label="__('Last name')" type="text" required autofocus autocomplete="lastname" />

                <!-- Profile Image Display + Upload -->
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-medium text-gray-700 dark:text-gray-200">Profile Picture</label>

                    <!-- Current Image -->


                    <!-- Preview New Upload -->


                    <!-- File Input -->
                    <input type="file" wire:model="profileImage" class="mt-2">
                    @error('profileImage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <flux:input wire:model="email" :label="__('Email')" type="email" required autocomplete="email" />

                    @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                        <div>
                            <flux:text class="mt-4">
                                {{ __('Your email address is unverified.') }}

                                <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                    {{ __('Click here to re-send the verification email.') }}
                                </flux:link>
                            </flux:text>

                            @if (session('status') === 'verification-link-sent')
                                <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                    {{ __('A new verification link has been sent to your email address.') }}
                                </flux:text>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            <!-- Action buttons -->
            <div class="flex items-center gap-4 mt-6">
                <flux:button variant="primary" type="submit" class="w-full md:w-auto">
                    {{ __('Save') }}
                </flux:button>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('Saved.') }}
                </x-action-message>
            </div>
        </form>

        <script>
    let cropper;
    const imageElement = document.getElementById('cropper-image');
    const fileInput = document.getElementById('profileImageInput');

    fileInput.addEventListener('change', function (e) {
        const file = e.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (event) {
            imageElement.src = event.target.result;

            if (cropper) cropper.destroy();
            cropper = new Cropper(imageElement, {
                aspectRatio: 1,
                viewMode: 1,
                responsive: true,
            });
        };
        reader.readAsDataURL(file);
    });

    // Example: You could hook this to a button to send cropped image to Livewire
    function getCroppedImage() {
        if (!cropper) return;
        cropper.getCroppedCanvas().toBlob((blob) => {
            @this.upload('profileImage', blob);
        }, 'image/jpeg');
    }
</script>

        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
