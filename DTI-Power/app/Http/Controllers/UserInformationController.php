<?php

namespace App\Http\Controllers;

use App\Models\user_information;
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
                ->paginate(4);

        return view('Auth.Admin.view.manage-user', compact('users'));
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
    public function update(Request $request, user_information $user_information)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(user_information $user_information)
    {
        //
    }
}
