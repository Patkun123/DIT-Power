<?php

namespace App\Livewire\Auth;

use App\Models\User_Information;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Register extends Component
{
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = 'user';

    // Additional user information fields
    public ?string $phone_number = null;
    public ?string $gender = null;
    public ?string $birthday = null;
    public ?string $address = null;
    public ?string $height = null;
    public ?string $weight = null;
    public ?string $activity_level = null;
    public ?string $health_goals = null;
    public ?string $dietary_preferences = null;

    public int $step = 1;

    public function nextStep(): void
    {
        $this->validateCurrentStep();
        $this->step++;
    }

    public function previousStep(): void
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function register(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'firstname' => ['required', 'string', 'max:255'],
            'lastname'  => ['required', 'string', 'max:255'],
            'password'  => ['required', 'confirmed', Password::defaults()],
            'phone_number'          => ['nullable', 'string'],
            'gender'                => ['nullable', 'string'],
            'birthday'              => ['nullable', 'date'],
            'address'               => ['nullable', 'string'],
            'height'                => ['nullable', 'string'],
            'weight'                => ['nullable', 'string'],
            'activity_level'        => ['nullable', 'string'],
            'health_goals'          => ['nullable', 'string'],
            'dietary_preferences'   => ['nullable', 'string'],
        ]);

        // If password is filled in, hash it before saving
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // avoid overwriting with null
        }

        // Update user record
        $user->fill($validated);
        $user->save();

        // Create or update user information
        User_Information::create([
            'user_id'             => $user->id,
            'phone_number'        => $this->phone_number,
            'gender'              => $this->gender,
            'birthday'            => $this->birthday,
            'address'             => $this->address,
            'height'              => $this->height,
            'weight'              => $this->weight,
            'activity_level'      => $this->activity_level,
            'health_goals'        => $this->health_goals,
            'dietary_preferences' => $this->dietary_preferences,
        ]);

    event(new Registered($user));

    $this->redirect(route('dashboard', absolute: false), navigate: true);
}

    protected function validateCurrentStep(): void
    {
        if ($this->step === 1) {
            $this->validate([
                'firstname' => ['required', 'string', 'max:255'],
                'lastname'  => ['required', 'string', 'max:255'],
                'birthday'            => ['nullable', 'date'],
                'phone_number'        => ['nullable', 'string'],
                'gender'              => ['nullable', 'string'],
                'address'             => ['nullable', 'string'],
            ]);
        }

        if ($this->step === 2) {
            $this->validate([
                'height'              => ['nullable', 'string'],
                'weight'              => ['nullable', 'string'],
                'activity_level'      => ['nullable', 'string'],
                'health_goals'        => ['nullable', 'string'],
            ]);
        }

        if ($this->step === 3) {
            $this->validate([
                'dietary_preferences' => ['nullable', 'string'],
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
