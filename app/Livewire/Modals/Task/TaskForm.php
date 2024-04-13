<?php

namespace App\Livewire\Modals\Task;

use App\Models\Task;
use Barryvdh\Debugbar\Facades\Debugbar;
use LivewireUI\Modal\ModalComponent;

class TaskForm extends ModalComponent
{
    public $id;
    public $title;
    public $description;
    public $repetitionOption = 'iterations'; // [iterations, dates]
    public $frequencyOption = 'daily'; // [daily, weekly, monthly]
    public $selectedDays = [];
    public $selectedMonthDay = 1;
    public $iterations = 1;
    public $startDate;
    public $endDate;
    public $taskGroupId;
    public $taskGroups;
    // -----------------------------------------------------------------------------------------------------------------
    // @ Static Functions
    // -----------------------------------------------------------------------------------------------------------------
    /**
     * Supported: 'sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl'
     */
    public static function modalMaxWidth(): string
    {
        return 'md';
    }

    // -----------------------------------------------------------------------------------------------------------------
    // @ Rules
    // -----------------------------------------------------------------------------------------------------------------
    protected $rules = [
        'title' => 'required',
        'description' => 'nullable',
        'frequencyOption' => 'required|in:daily,weekly,monthly',
        'selectedDays' => 'required_if:frequencyOption,weekly|array',
        // 'selectedDays.*' => 'required_if:frequencyOption,weekly',
        'selectedMonthDay' => 'required_if:frequencyOption,monthly|integer|min:1|max:31',
        'repetitionOption' => 'required|in:iterations,dates',
        'iterations' => 'required_if:repetitionOption,iterations|integer|min:1',
        'startDate' => 'required_with:endDate|date|after_or_equal:today',
        'endDate' => 'required_with:startDate|date|after:startDate',
    ];
    // -----------------------------------------------------------------------------------------------------------------
    // @ Listeners
    // -----------------------------------------------------------------------------------------------------------------

    // -----------------------------------------------------------------------------------------------------------------
    // @ Lifecycle Hooks
    // -----------------------------------------------------------------------------------------------------------------
    public function mount()
    {
        $task = Task::find($this->id);
        $this->taskGroups = auth()->user()->taskGroups()->get();
        if(!$task) {
            return;
        }
        $cronParts = explode(' ', $task->frequency);

        $this->frequencyOption = 'daily';
        $this->selectedDays = [];
        $this->selectedMonthDay = 1;
    
        if ($cronParts[2] != '*') {
            $this->frequencyOption = 'monthly';
            $this->selectedMonthDay = (int)$cronParts[2];
        } elseif ($cronParts[4] != '*') {
            $this->frequencyOption = 'weekly';
            $this->selectedDays = array_map('intval', explode(',', $cronParts[4]));
        }

        $this->title = $task->title ?? '';
        $this->description = $task->description ?? '';
        $this->iterations = $task->repetitions ?? 1;
        $this->startDate = $task->start_date ?? null;
        $this->endDate = $task->end_date ?? null;

        if($this->startDate && $this->endDate) {
            $this->repetitionOption = 'dates';
        }
    }
    // -----------------------------------------------------------------------------------------------------------------
    // @ Computed Properties
    // -----------------------------------------------------------------------------------------------------------------

    // -----------------------------------------------------------------------------------------------------------------
    // @ Public Functions
    // -----------------------------------------------------------------------------------------------------------------
    public function validateData()
    {
        $rules = $this->rules;

        if ($this->repetitionOption === 'dates') {
            $rules['startDate'] = 'required|date|after_or_equal:today';
            $rules['endDate'] = 'required|date|after:startDate';
        } else {
            unset($rules['startDate'], $rules['endDate']);
        }

        return $this->validate($rules);
    }
    
    public function saveTask() 
    {
        $this->validateData();

        $cronString = '';
        switch ($this->frequencyOption) {
            case 'daily':
                $cronString = '0 0 * * *';
                break;
            case 'weekly':
                $daysOfWeek = implode(',', $this->selectedDays);
                $cronString = "0 0 * * $daysOfWeek"; 
                break;
            case 'monthly':
                $cronString =  "0 0 $this->selectedMonthDay * *"; 
                break;
            default:
                $cronString = '0 0 * * *';
                break;
        }


        if($this->repetitionOption == 'dates') {
            $this->iterations = null;
        }

        if($this->repetitionOption == 'iterations') {
            $this->startDate = null;
            $this->endDate = null;
        }


        $task = Task::updateOrCreate([
            'id' => $this->id
        ], [
            'title' => $this->title,
            'description' => $this->description,
            'frequency' => $cronString,
            'repetitions' => $this->iterations,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'task_group_id' => $this->taskGroupId == 'null' ? null : $this->taskGroupId,
            'user_id' => auth()->id(),
        ]);

        $this->dispatch('refreshPage');
        $this->closeModal();
    }
    // -----------------------------------------------------------------------------------------------------------------
    // @ Private Functions
    // -----------------------------------------------------------------------------------------------------------------

    // -----------------------------------------------------------------------------------------------------------------
    // @ Render
    // -----------------------------------------------------------------------------------------------------------------
    
    public function render()
    {
        return view('livewire.modals.task.task-form');
    }
}