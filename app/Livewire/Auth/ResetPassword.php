<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\User;

#[Layout('components.layouts.auth')]
class ResetPassword extends Component
{
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Reset the password for the user stored in session.
     */
    public function resetPassword(): void
    {
        $this->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $userId = session('reset_user_id');

        if (! $userId) {
            abort(403, 'Session expired. Please start the reset process again.');
        }

        $user = User::findOrFail($userId);

        $user->forceFill([
            'password' => Hash::make($this->password),
        ])->save();

        // Clear reset session
        Session::forget('reset_user_id');

        session()->flash('status', 'Your password has been updated successfully.');

        $this->redirectRoute('login', navigate: true);
    }
}
