<?php

namespace App\Livewire\Tasks;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{

    // -----------------------------------------------------------------------------------------------------------------
    // @ Public Functions
    // -----------------------------------------------------------------------------------------------------------------

    public function render()
    {
        return view('livewire.tasks.dashboard');
    }
}
