<?php

namespace App\Livewire\Tasks;

use App\Http\Traits\WithTable;
use App\Models\TaskGroup;
use Barryvdh\Debugbar\Facades\Debugbar;
use Livewire\Component;

class TaskGroups extends Component
{
    use WithTable;

    // -----------------------------------------------------------------------------------------------------------------
    // @ Rules
    // -----------------------------------------------------------------------------------------------------------------

    // -----------------------------------------------------------------------------------------------------------------
    // @ Listeners
    // -----------------------------------------------------------------------------------------------------------------
    protected $listeners = ['refreshPage' => 'refreshPage'];

    public function refreshPage()
    {
        $this->resetPage();
    }
    // -----------------------------------------------------------------------------------------------------------------
    // @ Lifecycle Hooks
    // -----------------------------------------------------------------------------------------------------------------

    // -----------------------------------------------------------------------------------------------------------------
    // @ Computed Properties
    // -----------------------------------------------------------------------------------------------------------------
    public function getTaskGroupsQueryProperty()
    {
        return TaskGroup::filter(
            $this->search,
            $this->sortByAttribute,
            $this->sortDirection,
            auth()->id(),
        );
    }

    public function getTaskGroupsProperty()
    {
        $taskGroupsQuery = clone $this->task_groups_query;

        return $taskGroupsQuery->paginate(2);
    }
    // -----------------------------------------------------------------------------------------------------------------
    // @ Public Functions
    // -----------------------------------------------------------------------------------------------------------------
    
    // -----------------------------------------------------------------------------------------------------------------
    // @ Private Functions
    // -----------------------------------------------------------------------------------------------------------------

    // -----------------------------------------------------------------------------------------------------------------
    // @ Render
    // -----------------------------------------------------------------------------------------------------------------
    
    public function render()
    {
        return view('livewire.tasks.task-groups');
    }
}