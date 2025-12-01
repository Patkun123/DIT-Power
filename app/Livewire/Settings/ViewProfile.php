<?php

namespace App\Livewire\Settings;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ViewProfile extends Component
{
    public function render()
    {
        $user = Auth::user();
        $userInfo = $user->information;
        $staffInfo = $user->staff;

        return view('livewire.settings.view-profile', [
            'user' => $user,
            'userInfo' => $userInfo,
            'staffInfo' => $staffInfo,
        ]);
    }
}
