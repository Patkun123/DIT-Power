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
    public string $password = '';
    public string $password_confirmation = '';
    public string $role = 'user';

    public string $civil_status = '';
    public string $career = '';
    public string $level_career = '';
    public ?string $years_in_dti = null;
    public string $nature_of_work = '';
    public string $function = '';
    public string $educational_attachment_type = '';
    public string $educational_attachment = '';

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

    public function mount(): void
    {
        $user = Auth::user();

        if ($user) {
            // Pre-populate user data if available
            $this->firstname = $user->firstname ?? '';
            $this->lastname = $user->lastname ?? '';

            // Pre-populate user information if available
            if ($user->information) {
                $info = $user->information;
                $this->phone_number = $info->phone_number ?? null;
                $this->gender = $info->gender ?? null;
                $this->birthday = $info->birthday ? $info->birthday->format('Y-m-d') : null;
                $this->address = $info->address ?? null;
                $this->height = $info->height ?? null;
                $this->weight = $info->weight ?? null;
                $this->activity_level = $info->activity_level ?? null;
                $this->health_goals = $info->health_goals ?? null;
                $this->dietary_preferences = $info->dietary_preferences ?? null;
                $this->civil_status = $info->civil_status ?? '';
                $this->career = $info->career ?? '';
                $this->level_career = $info->level_career ?? '';
                $this->years_in_dti = $info->years_in_dti ?? null;
                $this->nature_of_work = $info->nature_of_work ?? '';
                $this->function = $info->function ?? '';
                $this->educational_attachment_type = $info->educational_attachment_type ?? '';
                $this->educational_attachment = $info->educational_attachment ?? '';
            }

            // Pre-populate DTI ID information if available
            if ($user->staff) {
                $staff = $user->staff;
                $this->staff_id = $staff->staff_id ?? null;
                $this->office = $staff->office ?? null;
                $this->position = $staff->position ?? null;
                $this->department = $staff->department ?? null;
            }
        }
    }

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
        try {
            $user = Auth::user();

            if (!$user) {
                session()->flash('error', 'You must be logged in to complete registration.');
                return;
            }

            // Check if user already has a password
            $userHasPassword = !empty($user->password);

            // Build password validation rules
            $passwordRules = $userHasPassword
                ? ['nullable', 'confirmed', Password::defaults()]
                : ['required', 'confirmed', Password::defaults()];

            // Check for existing dti_id record to handle unique validation
            $existingDtiId = $user->staff;
            $staffIdRule = ['required', 'string', 'max:255'];
            if ($existingDtiId) {
                // If updating existing record, ignore current record's staff_id
                $staffIdRule[] = 'unique:dti_id,staff_id,' . $existingDtiId->id;
            } else {
                // If creating new record, staff_id must be unique
                $staffIdRule[] = 'unique:dti_id,staff_id';
            }

            $validated = $this->validate([
                'firstname' => ['required', 'string', 'max:255'],
                'lastname'  => ['required', 'string', 'max:255'],
                'password'  => $passwordRules,
                'phone_number'          => ['required', 'string', 'max:20'],
                'gender'                => ['nullable', 'string'],
                'birthday'              => ['nullable', 'date'],
                'address'               => ['required', 'string', 'max:500'],
                'height'                => ['required', 'string', 'max:10'],
                'weight'                => ['required', 'string', 'max:10'],
                'activity_level'        => ['nullable', 'string'],
                'health_goals'          => ['nullable', 'string'],
                'dietary_preferences'   => ['nullable', 'string'],
                'staff_id'              => $staffIdRule,
                'office'                => ['required', 'string', 'max:255'],
                'position'              => ['required', 'string', 'max:255'],
                'department'            => ['required', 'string', 'max:255'],
                'career'                => ['required', 'string', 'max:255'],
                'level_career'          => ['nullable', 'string', 'max:255'],
                'years_in_dti'          => ['nullable', 'string', 'max:10'],
                'civil_status'          => ['nullable', 'string'],
                'nature_of_work'        => ['nullable', 'string'],
                'function'              => ['nullable', 'string'],
                'educational_attachment_type' => ['nullable', 'string'],
                'educational_attachment'      => ['nullable', 'string'],
            ]);

            // Update user record - only fields that belong to users table
            $user->firstname = $validated['firstname'];
            $user->lastname = $validated['lastname'];

            // If password is filled in, hash it before saving
            if (!empty($validated['password'])) {
                $user->password = Hash::make($validated['password']);
            }

            $user->save();

            // Create or update user information
            user_information::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'phone_number'        => $this->phone_number,
                    'gender'              => $this->gender,
                    'birthday'            => $this->birthday,
                    'address'             => $this->address,
                    'height'              => $this->height,
                    'weight'              => $this->weight,
                    'activity_level'      => $this->activity_level,
                    'health_goals'        => $this->health_goals,
                    'dietary_preferences' => $this->dietary_preferences,
                    'civil_status'        => $this->civil_status ?: 'Single',
                    'career'              => $this->career,
                    'level_career'        => $this->level_career ?: '1st',
                    'years_in_dti'        => $this->years_in_dti,
                    'nature_of_work'      => $this->nature_of_work ?: '',
                    'function'            => $this->function ?: '',
                    'educational_attachment_type' => $this->educational_attachment_type ?: '',
                    'educational_attachment'      => $this->educational_attachment ?: '',
                ]
            );

            // Update or create DTI ID record
            dti_id::updateOrCreate(
                // Conditions to find the existing record
                ['user_id' => $user->id],
                // Values to update if found, or insert if not found
                [
                    'staff_id'   => $this->staff_id,
                    'office'     => $this->office,
                    'position'  => $this->position,
                    'department' => $this->department,
                ]
            );

            event(new Registered($user));

            session()->flash('success', 'Registration completed successfully! Welcome to DIT-Power.');

            $this->redirect(route('index', absolute: false), navigate: true);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Re-throw validation exceptions so Livewire can handle them
            throw $e;
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle database errors (like missing columns)
            \Log::error('Registration database error: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => Auth::id(),
                'sql' => $e->getSql() ?? null,
            ]);

            $errorMessage = 'A database error occurred. ';
            if (str_contains($e->getMessage(), 'years_in_dti')) {
                $errorMessage .= 'Please run the migration: php artisan migrate';
            } else {
                $errorMessage .= 'Please contact support.';
            }

            session()->flash('error', $errorMessage);
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Registration error: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString(),
            ]);

            session()->flash('error', 'An error occurred during registration: ' . $e->getMessage());
        }
    }

    protected function validateCurrentStep(): void
    {
        if ($this->step === 1) {
            $this->validate([
                'firstname' => ['required', 'string', 'max:255'],
                'lastname'  => ['required', 'string', 'max:255'],
                'phone_number' => ['required', 'string', 'max:20'],
                'address'   => ['required', 'string', 'max:500'],
                'birthday'  => ['nullable', 'date'],
                'gender'    => ['nullable', 'string'],
                'civil_status' => ['nullable', 'string'],
            ]);
        }

        if ($this->step === 2) {
            // HR Profile - Career Information
            $user = Auth::user();
            $existingDtiId = $user->staff;
            $staffIdRule = ['required', 'string', 'max:255'];
            if ($existingDtiId) {
                // If updating existing record, ignore current record's staff_id
                $staffIdRule[] = 'unique:dti_id,staff_id,' . $existingDtiId->id;
            } else {
                // If creating new record, staff_id must be unique
                $staffIdRule[] = 'unique:dti_id,staff_id';
            }

            $this->validate([
                'staff_id'      => $staffIdRule,
                'career'        => ['required', 'string', 'max:255'],
                'level_career'  => ['nullable', 'string', 'max:255'],
                'years_in_dti'  => ['nullable', 'string', 'max:10'],
                'office'        => ['required', 'string', 'max:255'],
                'position'      => ['required', 'string', 'max:255'],
                'department'    => ['required', 'string', 'max:255'],
            ]);
        }

        if ($this->step === 3) {
            // Health Profile
            $this->validate([
                'height'            => ['required', 'string', 'max:10'],
                'weight'            => ['required', 'string', 'max:10'],
                'activity_level'    => ['nullable', 'string'],
                'health_goals'      => ['nullable', 'string'],
                'dietary_preferences' => ['nullable', 'string'],
            ]);
        }

        if ($this->step === 4) {
            // Password only
            $user = Auth::user();
            $userHasPassword = !empty($user->password);

            $passwordRules = $userHasPassword
                ? ['nullable', 'confirmed', Password::defaults()]
                : ['required', 'confirmed', Password::defaults()];

            $this->validate([
                'password' => $passwordRules,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
