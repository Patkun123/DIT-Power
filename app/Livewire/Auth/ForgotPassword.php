<?php

namespace App\Livewire\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Validation\ValidationException;
use App\Models\User;
use App\Models\dti_id;

#[Layout('components.layouts.auth')]
class ForgotPassword extends Component
{
    public string $email = '';
    public string $staff_id = '';

    public function verifyAccount(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
            'staff_id' => ['required', 'string'],
        ]);

        $user = User::where('email', $this->email)->first();

        if (! $user) {
            throw ValidationException::withMessages([
                'email' => __('No account found with this email.'),
            ]);
        }

        $staff = dti_id::where('user_id', $user->id)
                        ->where('staff_id', $this->staff_id)
                        ->first();

        if (! $staff) {
            throw ValidationException::withMessages([
                'dti_id' => __('The DTI ID does not match our records.'),
            ]);
        }

        // Store user ID in session (so we know who is resetting password)
        session(['reset_user_id' => $user->id]);

        // Redirect to reset password form
        $this->redirectRoute('password.reset', ['token' => 'manual-flow']);
    }
}
