<?php

namespace App\Livewire\Tasks;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalTasks = 0;
    public $completedTasks = 0;

     // -----------------------------------------------------------------------------------------------------------------
    // @ Lifecycle Hooks
    // -----------------------------------------------------------------------------------------------------------------
    public function mount()
    {
        $this->totalTasks = Auth::user()->tasks()->count();
        $this->completedTasks = Auth::user()->tasks()->whereHas('generatedTasks', function ($query) {
            $query->where('is_done', true);
        })->count();
    }
    // -----------------------------------------------------------------------------------------------------------------
    // @ Public Functions
    // -----------------------------------------------------------------------------------------------------------------

    public function render()
    {
        return view('livewire.tasks.dashboard');
    }
}
