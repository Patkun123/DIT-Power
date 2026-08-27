<?php

namespace App\Http\Controllers;

use App\Models\user_information;
use App\Services\ActivityService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\dti_id;
use Illuminate\Support\Facades\Hash;
use SweetAlert2\Laravel\Swal;

class UserInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with(['staff', 'information'])
                ->where('role', '!=', 'admin') // Exclude admins
                ->get();

        return view('auth.admin.view.manage-user', compact('users'));
    }

    /**
     * Display user progress with search and registration/update sorting.
     */
    public function progress(Request $request)
    {
        $validated = $request->validate([
            'search' => 'nullable|string|max:100',
            'sort' => 'nullable|in:created_at,updated_at',
            'direction' => 'nullable|in:asc,desc',
        ]);

        $search = trim($validated['search'] ?? '');
        $sort = $validated['sort'] ?? 'created_at';
        $direction = $validated['direction'] ?? 'desc';

        $users = User::withCount('journals')
            ->with(['staff', 'information'])
            ->where('role', '!=', 'admin')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query->where('firstname', 'like', "%{$search}%")
                        ->orWhere('lastname', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhereHas('staff', function ($query) use ($search) {
                            $query->where('office', 'like', "%{$search}%");
                        });
                });
            })
            ->orderBy($sort, $direction)
            ->get();

        return view('auth.admin.view.user-tracking', compact('users', 'search', 'sort', 'direction'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'email' => 'required|email|unique:users,email',
                'office' => 'required',
                'password' => 'required|min:6',
            ]);

            // Save user and link staff_id
            $user = User::create([
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            // Save to staff_id table
            dti_id::create([
                'office' => $validated['office'],
                'user_id' => $user->id,
            ]);

            // Log user added activity
            ActivityService::logUserAdded(
                auth()->id(),
                $user->email
            );

            Swal::toastSuccess([
                'title' => 'User created successfully!',
                'position' => 'top-end',
                'showConfirmButton' => false,
                'timer' => 3000,
            ]);

            return redirect()->back()->with('success', 'User added successfully!');
        } catch (\Exception $e) {

            Swal::toastError([
                'title' => 'An error occurred while creating the user!',
                'position' => 'top-end',
                'showConfirmButton' => false,
                'timer' => 3000,
            ]);

            return redirect()->back()->with('error', 'Failed to add user. Please try again.');
        }
    }



    /**
     * Display the specified resource.
     */
    public function show(user_information $user_information)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(user_information $user_information)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'firstname' => 'nullable|string|max:255',
            'lastname' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'office' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6',
        ]);

        // Update basic user fields
        $user->email = $validated['email'];
        if (!empty($validated['firstname'])) {
            $user->firstname = $validated['firstname'];
        }
        if (!empty($validated['lastname'])) {
            $user->lastname = $validated['lastname'];
        }
        if (!empty($validated['password'])) {
            $user->password = Hash::make($validated['password']);
        }
        $user->save();

        // Update office in related dti_id record if provided
        if (!empty($validated['office'])) {
            $staff = dti_id::firstOrNew(['user_id' => $user->id]);
            $staff->office = $validated['office'];
            $staff->save();
        }

        Swal::toastSuccess([
            'title' => 'User updated successfully!',
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 3000,
        ]);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Optionally delete related records
        dti_id::where('user_id', $user->id)->delete();
        user_information::where('user_id', $user->id)->delete();

        $email = $user->email;
        $user->delete();

        ActivityService::logUserRemoved(auth()->id(), $email ?? '');

        Swal::toastSuccess([
            'title' => 'User deleted successfully!',
            'position' => 'top-end',
            'showConfirmButton' => false,
            'timer' => 3000,
        ]);

        return back();
    }
}
