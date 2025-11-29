<?php

namespace App\Livewire\Settings;

use App\Models\User;
use App\Models\user_information;
use App\Models\dti_id;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profile extends Component
{
    use WithFileUploads;

    // Basic user info
    public string $firstname = '';
    public string $lastname = '';
    public string $email = '';
    public string $bio = '';
    public $profileImage; // For uploads

    // Personal Information
    public ?string $phone_number = null;
    public ?string $gender = null;
    public ?string $birthday = null;
    public ?string $address = null;
    public ?string $civil_status = null;

    // Health Information
    public ?string $height = null;
    public ?string $weight = null;
    public ?string $activity_level = null;
    public ?string $health_goals = null;
    public ?string $dietary_preferences = null;

    // Career Information
    public ?string $staff_id = null;
    public ?string $office = null;
    public ?string $position = null;
    public ?string $department = null;
    public ?string $nature_of_work = null;
    public ?string $level_career = null;
    public ?string $years_in_dti = null;

    public function mount(): void
    {
        $user = Auth::user()->load('information', 'staff');
        
        // Basic user info
        $this->firstname = $user->firstname;
        $this->lastname = $user->lastname;
        $this->email = $user->email;
        $this->bio = $user->bio ?? '';
        $this->profileImage = $user->profileimage;

        // Personal Information
        if ($user->information) {
            $this->phone_number = $user->information->phone_number;
            $this->gender = $user->information->gender;
            $this->birthday = $user->information->birthday ? $user->information->birthday->format('Y-m-d') : null;
            $this->address = $user->information->address;
            $this->civil_status = $user->information->civil_status;
            $this->height = $user->information->height;
            $this->weight = $user->information->weight;
            $this->activity_level = $user->information->activity_level;
            $this->health_goals = $user->information->health_goals;
            $this->dietary_preferences = $user->information->dietary_preferences;
        }

        // Career Information
        if ($user->staff) {
            $this->staff_id = $user->staff->staff_id;
            $this->office = $user->staff->office;
            $this->position = $user->staff->position;
            $this->department = $user->staff->department;
        }

        if ($user->information) {
            $this->nature_of_work = $user->information->nature_of_work;
            $this->level_career = $user->information->level_career;
            $this->years_in_dti = $user->information->years_in_dti;
        }
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'firstname'    => ['nullable', 'string', 'max:255'],
            'lastname'     => ['nullable', 'string', 'max:255'],
            'bio'          => ['nullable', 'string', 'max:500'],
            'profileImage' => ['nullable', 'image'],
            'email'        => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id),
            ],
            // Personal Information
            'phone_number' => ['nullable', 'string'],
            'gender' => ['nullable', 'string'],
            'birthday' => ['nullable', 'date'],
            'address' => ['nullable', 'string'],
            'civil_status' => ['nullable', 'string'],
            // Health Information
            'height' => ['nullable', 'string'],
            'weight' => ['nullable', 'string'],
            'activity_level' => ['nullable', 'string'],
            'health_goals' => ['nullable', 'string'],
            'dietary_preferences' => ['nullable', 'string'],
            // Career Information
            'staff_id' => ['nullable', 'string', 'max:255'],
            'office' => ['nullable', 'string'],
            'position' => ['nullable', 'string'],
            'department' => ['nullable', 'string'],
            'nature_of_work' => ['nullable', 'string'],
            'level_career' => ['nullable', 'string'],
            'years_in_dti' => ['nullable', 'string'],
        ]);

        // Handle image upload if present
        if ($this->profileImage && is_object($this->profileImage)) {
            $validated['profileimage'] = $this->profileImage->store('profile', 'public');
        }

        // Update basic user info
        $user->fill($validated);
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }
        $user->save();

        // Update or create user information
        user_information::updateOrCreate(
            ['user_id' => $user->id],
            [
                'phone_number' => $this->phone_number,
                'gender' => $this->gender,
                'birthday' => $this->birthday,
                'address' => $this->address,
                'civil_status' => $this->civil_status ?: 'Single',
                'height' => $this->height,
                'weight' => $this->weight,
                'activity_level' => $this->activity_level,
                'health_goals' => $this->health_goals,
                'dietary_preferences' => $this->dietary_preferences,
                'nature_of_work' => $this->nature_of_work,
                'level_career' => $this->level_career,
                'years_in_dti' => $this->years_in_dti,
            ]
        );

        // Update or create DTI ID information
        dti_id::updateOrCreate(
            ['user_id' => $user->id],
            [
                'staff_id' => $this->staff_id,
                'office' => $this->office,
                'position' => $this->position,
                'department' => $this->department,
            ]
        );

        $this->dispatch('profile-updated', name: $user->firstname);
    }

    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }
}
