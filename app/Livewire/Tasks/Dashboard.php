<?php

namespace App\Livewire\Tasks;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{

    // -----------------------------------------------------------------------------------------------------------------
    // @ Public Functions
    // -----------------------------------------------------------------------------------------------------------------
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }

    public function render()
    {
        return view('livewire.tasks.dashboard');
    }
}
