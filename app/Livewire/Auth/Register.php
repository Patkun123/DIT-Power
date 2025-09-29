<?php

namespace App\Livewire\Auth;

use App\Models\dti_id;
use App\Models\user_information;
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

    public string $civil_status = '';
    public string $career = '';
    public string $level_career = '';
    public string $nature_of_work = '';
    public string $function = '';
    public string $educational_attachment_type = '';
    public string $educational_attachment = '';
    
    public function updatedEducationalAttachmentType()
    {
        // Clear the educational attachment when type changes
        $this->educational_attachment = '';
    }
    public string $post_graduate = 'none';

    public ?string $phone_number = null;
    public ?string $gender = null;
    public ?string $birthday = null;
    public ?string $address = null;
    public ?string $height = null;
    public ?string $weight = null;
    public ?string $activity_level = null;
    public ?string $health_goals = null;
    public ?string $dietary_preferences = null;

    public ?string $staff_id = null;

    public ?string $office = null;

    public ?string $position = null;

    public ?string $department = null;

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
            'civil_status'          => ['nullable', 'string'],
            'career'                => ['nullable', 'string'],
            'level_career'          => ['nullable', 'string'],
            'nature_of_work'        => ['nullable', 'string'],
            'function'              => ['nullable', 'string'],
            'educational_attachment_type' => ['nullable', 'string'],
            'educational_attachment'      => ['nullable', 'string'],
            'post_graduate'         => ['nullable', 'string'],
            'height'                => ['nullable', 'string'],
            'weight'                => ['nullable', 'string'],
            'activity_level'        => ['nullable', 'string'],
            'health_goals'          => ['nullable', 'string'],
            'dietary_preferences'   => ['nullable', 'string'],
            'staff_id'              => ['required', 'max:255'],
            'office'                => ['nullable', 'string'],
            'position'              => ['nullable', 'string'],
            'department'            => ['nullable', 'string'],
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
        user_information::create([
            'user_id'                     => $user->id,
            'staff_id'                    => $this->staff_id,
            'phone_number'                => $this->phone_number,
            'gender'                      => $this->gender,
            'birthday'                    => $this->birthday,
            'address'                     => $this->address,
            'civil_status'                => $this->civil_status,
            'career'                      => $this->career,
            'level_career'                => $this->level_career,
            'nature_of_work'              => $this->nature_of_work,
            'function'                    => $this->function,
            'educational_attachment_type' => $this->educational_attachment_type,
            'educational_attachment'      => $this->educational_attachment,
            'post_graduate'               => $this->post_graduate,
            'height'                      => $this->height,
            'weight'                      => $this->weight,
            'activity_level'              => $this->activity_level,
            'health_goals'                => $this->health_goals,
            'dietary_preferences'         => $this->dietary_preferences,
        ]);

        dti_id::updateOrCreate(
        // Conditions to find the existing record
        [
        'user_id'    => $user->id,
        'office' => $this->office
    ],

        // Values to update if found, or insert if not found
        [
            'staff_id' => $this->staff_id,
            'position'   => $this->position,
            'department' => $this->department,
        ]
    );


    event(new Registered($user));

    $this->redirect(route('index', absolute: false), navigate: true);
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
                'career'                      => ['nullable', 'string'],
                'level_career'                => ['nullable', 'string'],
                'nature_of_work'              => ['nullable', 'string'],
                'function'                    => ['nullable', 'string'],
                'educational_attachment_type' => ['nullable', 'string'],
                'educational_attachment'      => ['nullable', 'string'],
                'post_graduate'               => ['nullable', 'string'],
            ]);
        }

        if ($this->step === 3) {
            $this->validate([
                'height'                      => ['nullable', 'string'],
                'weight'                      => ['nullable', 'string'],
                'activity_level'              => ['nullable', 'string'],
                'health_goals'                => ['nullable', 'string'],
                'dietary_preferences' => ['nullable', 'string'],
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
