<?php

namespace App\Livewire\Tasks;

use App\Models\TaskGroup;
use Livewire\Component;
use Livewire\WithPagination;

class TaskGroups extends Component
{
    use WithPagination;
    // -----------------------------------------------------------------------------------------------------------------
    // @ Rules
    // -----------------------------------------------------------------------------------------------------------------

    // -----------------------------------------------------------------------------------------------------------------
    // @ Listeners
    // -----------------------------------------------------------------------------------------------------------------

    // -----------------------------------------------------------------------------------------------------------------
    // @ Lifecycle Hooks
    // -----------------------------------------------------------------------------------------------------------------

    // -----------------------------------------------------------------------------------------------------------------
    // @ Computed Properties
    // -----------------------------------------------------------------------------------------------------------------
    public function getTaskGroupsQueryProperty()
    {
        return TaskGroup::filter(
            '',
            'id',
            'ASC',
            auth()->id(),
        );
    }

    public function getTaskGroupsProperty()
    {
        $taskGroupsQuery = clone $this->task_groups_query;

        return $taskGroupsQuery->paginate(25);
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