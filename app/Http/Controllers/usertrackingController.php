<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;


class usertrackingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        $sort = $request->input('sort', 'recent');

        $usersQuery = User::with(['staff'])
            ->withCount(['journals']);

        if ($search) {
            $usersQuery->where(function ($query) use ($search) {
                $query->where('firstname', 'like', "%{$search}%")
                    ->orWhere('lastname', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhereHas('staff', function ($staffQuery) use ($search) {
                        $staffQuery->where('staff_id', 'like', "%{$search}%")
                            ->orWhere('office', 'like', "%{$search}%")
                            ->orWhere('department', 'like', "%{$search}%")
                            ->orWhere('position', 'like', "%{$search}%");
                    });
            });
        }

        switch ($sort) {
            case 'name_asc':
                $usersQuery->orderBy('firstname')->orderBy('lastname');
                break;
            case 'name_desc':
                $usersQuery->orderByDesc('firstname')->orderByDesc('lastname');
                break;
            case 'journals_desc':
                $usersQuery->orderByDesc('journals_count');
                break;
            case 'recent':
            default:
                $usersQuery->orderByDesc('updated_at');
                break;
        }

        $users = $usersQuery->get();

        return view('auth.admin.view.user-tracking', compact('users', 'search', 'sort'));
    }

    /**return view('auth.admin.view.user-tracking');
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
