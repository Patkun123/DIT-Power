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
    public string $nature_of_work = '';
    public string $function = '';
    public string $educational_attachment_type = '';
    public string $educational_attachment = '';

    public ?string $phone_number = null;
    public ?string $gender = '';
    public ?string $birthday = null;
    public ?string $address = null;
    public ?string $height = null;
    public ?string $weight = null;
    public ?string $activity_level = '';
    public ?string $health_goals = '';
    public ?string $dietary_preferences = '';

    public ?string $staff_id = null;

    public ?string $office = '';

    public ?string $position = null;

    public ?string $department = null;

    public ?string $years_in_dti = null;

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
        try {
            $user = Auth::user();

            if (!$user) {
                session()->flash('error', 'You must be logged in to complete registration.');
                return;
            }

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
                'staff_id'              => ['required', 'max:255'],
                'office'                => ['nullable', 'string'],
                'position'              => ['nullable', 'string'],
                'department'            => ['nullable', 'string'],
                'civil_status'          => ['nullable', 'string'],
                'career'                => ['nullable', 'string'],
                'level_career'          => ['nullable', 'string'],
                'years_in_dti'          => ['nullable', 'string'],
                'nature_of_work'        => ['nullable', 'string'],
                'function'              => ['nullable', 'string'],
                'educational_attachment_type' => ['nullable', 'string'],
                'educational_attachment'      => ['nullable', 'string'],
                'years_in_dti'          => ['nullable', 'string'],
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
            user_information::updateOrCreate(
                ['user_id' => $user->id],
                [
                    'phone_number'        => !empty($this->phone_number) ? $this->phone_number : null,
                    'gender'              => !empty($this->gender) ? $this->gender : null,
                    'birthday'            => !empty($this->birthday) ? $this->birthday : null,
                    'address'             => !empty($this->address) ? $this->address : null,
                    'height'              => !empty($this->height) ? $this->height : null,
                    'weight'              => !empty($this->weight) ? $this->weight : null,
                    'activity_level'      => !empty($this->activity_level) ? $this->activity_level : null,
                    'health_goals'        => !empty($this->health_goals) ? $this->health_goals : null,
                    'dietary_preferences' => !empty($this->dietary_preferences) ? $this->dietary_preferences : null,
                    'civil_status'        => !empty($this->civil_status) ? $this->civil_status : 'Single',
                    'career'              => !empty($this->career) ? $this->career : null,
                    'level_career'        => !empty($this->level_career) ? $this->level_career : '1st',
                    'nature_of_work'      => !empty($this->nature_of_work) ? $this->nature_of_work : null,
                    'function'            => !empty($this->function) ? $this->function : null,
                    'educational_attachment_type' => !empty($this->educational_attachment_type) ? $this->educational_attachment_type : null,
                    'educational_attachment'      => !empty($this->educational_attachment) ? $this->educational_attachment : null,
                    'years_in_dti'        => !empty($this->years_in_dti) ? $this->years_in_dti : null,
                ]
            );

            dti_id::updateOrCreate(
                // Conditions to find the existing record
                [
                    'user_id' => $user->id,
                    'office'  => $this->office
                ],
                // Values to update if found, or insert if not found
                [
                    'staff_id'   => $this->staff_id,
                    'position'   => $this->position,
                    'department' => $this->department,
                ]
            );

            event(new Registered($user));

            $this->redirect(route('index', absolute: false), navigate: true);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Re-throw validation exceptions so Livewire can handle them
            throw $e;
        } catch (\Exception $e) {
            // Log the error for debugging
            \Log::error('Registration error: ' . $e->getMessage(), [
                'exception' => $e,
                'user_id' => Auth::id(),
            ]);
            
            session()->flash('error', 'An error occurred during registration. Please try again or contact support.');
        }
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
                'civil_status'        => ['nullable', 'string'],
            ]);
        }

        if ($this->step === 2) {
            $this->validate([
                'staff_id'            => ['required', 'string', 'max:255'],
                'nature_of_work'      => ['nullable', 'string'],
                'level_career'        => ['nullable', 'string'],
                'years_in_dti'        => ['nullable', 'string'],
                'office'              => ['nullable', 'string'],
                'position'            => ['nullable', 'string'],
                'department'          => ['nullable', 'string'],
            ]);
        }

        if ($this->step === 3) {
            $this->validate([
                'height'              => ['nullable', 'string'],
                'weight'              => ['nullable', 'string'],
                'activity_level'      => ['nullable', 'string'],
                'health_goals'        => ['nullable', 'string'],
                'dietary_preferences' => ['nullable', 'string'],
            ]);
        }
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
