<?php

namespace App\Livewire\Tasks;

use App\Models\GeneratedTask;
use App\Models\Task;
use Carbon\Carbon;
use Livewire\Component;

class TaskListing extends Component
{
    public $todayTasks = [];
    public $tomorrowTasks = [];
    public $thisWeekTasks = [];
    public $nextWeekTasks = [];
    public $nearFutureTasks = [];
    public $futureTasks = [];
    // -----------------------------------------------------------------------------------------------------------------
    // @ Rules
    // -----------------------------------------------------------------------------------------------------------------

    // -----------------------------------------------------------------------------------------------------------------
    // @ Listeners
    // -----------------------------------------------------------------------------------------------------------------

    // -----------------------------------------------------------------------------------------------------------------
    // @ Lifecycle Hooks
    // -----------------------------------------------------------------------------------------------------------------
    public function mount()
    {
        $today = Carbon::today();
        $nextMonday = $today->copy()->dayOfWeek === Carbon::SUNDAY ? $today->copy()->addDay() : Carbon::now()->startOfWeek()->addWeek();
        $nextSunday = Carbon::now()->endOfWeek()->addWeek();
        $dayOfWeek = $today->dayOfWeek;

        $startDateNearFuture = $nextSunday->copy()->addDay();
        $endDateNearFuture = $startDateNearFuture->copy()->addMonthsNoOverflow(2);

        $startDateInTheFuture = $endDateNearFuture->copy()->addDay(); 
        $endDateInTheFuture = $startDateInTheFuture->copy()->addMonthsNoOverflow(2); 

        if ($dayOfWeek < Carbon::SATURDAY) {
            $thisMonday = $today->copy()->addDays(2); 
            $thisSunday = $today->copy()->endOfWeek(); 
        } else {
            $thisMonday = null;
            $thisSunday = null;
        }



        $this->todayTasks = Task::where('user_id', auth()->id())
            ->with(['generatedTasks' => function ($query) use ($today) {
                $query->whereDate('date', $today)->orderBy('date', 'asc');
            },
            'taskGroup'
            ])
            ->whereHas('generatedTasks', function ($query) use ($today) {
                $query->whereDate('date', $today);
            })
            ->get();

        $tomorrowGeneratedTasks = [];
        $tomorrowTasks = Task::where('user_id', auth()->id())
            ->with(['generatedTasks' => function ($query) use ($today) {
                $query->whereDate('date', $today->addDay())->orderBy('date', 'asc');
            },
            'taskGroup'
            ])
            ->whereHas('generatedTasks', function ($query) use ($today) {
                $query->whereDate('date', $today->addDay());
            })
            ->get();

            
            
        foreach ($tomorrowTasks as $task) {
            foreach ($task->generatedTasks as $generatedTask) {
                $tomorrowGeneratedTasks[] = [
                    'title' => $task->title,
                    'description' => $task->description,
                    'group' => $task->taskgroup->name ?? '',
                    'is_done' => $generatedTask->is_done,
                    'date' => $generatedTask->date,
                    'id' => $generatedTask->id,
                ];
            }
        }
        usort($tomorrowGeneratedTasks, function ($a, $b) {
            return strtotime($a['date']) - strtotime($b['date']);
        });

        $this->tomorrowTasks = $tomorrowGeneratedTasks;
        // dd($tomorrowGeneratedTasks);

        if($thisSunday != null) {
            $thisWeekGeneratedTasks = [];
            $thisWeekTasks = Task::where('user_id', auth()->id())
                ->with(['generatedTasks' => function ($query) use ($thisMonday, $thisSunday) {
                    $query->whereDate('date', '>=', $thisMonday)->whereDate('date', '<=', $thisSunday)->orderBy('date', 'asc');
                }, 'taskGroup'])
                ->whereHas('generatedTasks', function ($query) use ($thisMonday, $thisSunday) {
                    $query->whereDate('date', '>=', $thisMonday)->whereDate('date', '<=', $thisSunday);
                })
                ->get();
    
            foreach ($thisWeekTasks as $task) {
                foreach ($task->generatedTasks as $generatedTask) {
                    $thisWeekGeneratedTasks[] = [
                        'title' => $task->title,
                        'description' => $task->description,
                        'group' => $task->taskgroup->name ?? '',
                        'is_done' => $generatedTask->is_done,
                        'date' => $generatedTask->date,
                        'id' => $generatedTask->id,
                    ];
                }
            }
            usort($thisWeekGeneratedTasks, function ($a, $b) {
                return strtotime($a['date']) - strtotime($b['date']);
            });
            $this->thisWeekTasks = $thisWeekGeneratedTasks;
            // dd($nextWeekGeneratedTasks);
        }


        $nextWeekGeneratedTasks = [];
        $nextWeekTasks = Task::where('user_id', auth()->id())
            ->with(['generatedTasks' => function ($query) use ($nextMonday, $nextSunday) {
                $query->whereDate('date', '>=', $nextMonday)->whereDate('date', '<=', $nextSunday)->orderBy('date', 'asc');
            }, 'taskGroup'])
            ->whereHas('generatedTasks', function ($query) use ($nextMonday, $nextSunday) {
                $query->whereDate('date', '>=', $nextMonday)->whereDate('date', '<=', $nextSunday);
            })
            ->get();

        foreach ($nextWeekTasks as $task) {
            foreach ($task->generatedTasks as $generatedTask) {
                $nextWeekGeneratedTasks[] = [
                    'title' => $task->title,
                    'description' => $task->description,
                    'group' => $task->taskgroup->name ?? '',
                    'is_done' => $generatedTask->is_done,
                    'date' => $generatedTask->date,
                    'id' => $generatedTask->id,
                ];
            }
        }
        usort($nextWeekGeneratedTasks, function ($a, $b) {
            return strtotime($a['date']) - strtotime($b['date']);
        });
        $this->nextWeekTasks = $nextWeekGeneratedTasks;
        // dd($nextWeekGeneratedTasks);


        $nearFutureGeneratedTasks = [];
        $nearFutureTasks = Task::where('user_id', auth()->id())
            ->with(['generatedTasks' => function ($query) use ($startDateNearFuture, $endDateNearFuture) {
                $query->whereDate('date', '>=', $startDateNearFuture)->whereDate('date', '<=', $endDateNearFuture)->orderBy('date', 'asc');
            }, 'taskGroup'])
            ->whereHas('generatedTasks', function ($query) use ($startDateNearFuture, $endDateNearFuture) {
                $query->whereDate('date', '>=', $startDateNearFuture)->whereDate('date', '<=', $endDateNearFuture);
            })
            ->get();

        foreach ($nearFutureTasks as $task) {
            foreach ($task->generatedTasks as $generatedTask) {
                $nearFutureGeneratedTasks[] = [
                    'title' => $task->title,
                    'description' => $task->description,
                    'group' => $task->taskgroup->name ?? '',
                    'is_done' => $generatedTask->is_done,
                    'date' => $generatedTask->date,
                    'id' => $generatedTask->id,
                ];
            }
        }
        usort($nearFutureGeneratedTasks, function ($a, $b) {
            return strtotime($a['date']) - strtotime($b['date']);
        });
        $this->nearFutureTasks = $nearFutureGeneratedTasks;
        // dd($nextWeekGeneratedTasks);


        $futureGeneratedTasks = [];
        $futureTasks = Task::where('user_id', auth()->id())
            ->with(['generatedTasks' => function ($query) use ($startDateInTheFuture, $endDateInTheFuture) {
                $query->whereDate('date', '>=', $startDateInTheFuture)->whereDate('date', '<=', $endDateInTheFuture)->orderBy('date', 'asc');
            }, 'taskGroup'])
            ->whereHas('generatedTasks', function ($query) use ($startDateInTheFuture, $endDateInTheFuture) {
                $query->whereDate('date', '>=', $startDateInTheFuture)->whereDate('date', '<=', $endDateInTheFuture);
            })
            ->get();

        foreach ($futureTasks as $task) {
            foreach ($task->generatedTasks as $generatedTask) {
                $futureGeneratedTasks[] = [
                    'title' => $task->title,
                    'description' => $task->description,
                    'group' => $task->taskgroup->name ?? '',
                    'is_done' => $generatedTask->is_done,
                    'date' => $generatedTask->date,
                    'id' => $generatedTask->id,
                ];
            }
        }
        usort($futureGeneratedTasks, function ($a, $b) {
            return strtotime($a['date']) - strtotime($b['date']);
        });
        $this->futureTasks = $futureGeneratedTasks;
        // dd($nextWeekGeneratedTasks);
    }
    // -----------------------------------------------------------------------------------------------------------------
    // @ Computed Properties
    // -----------------------------------------------------------------------------------------------------------------

    // -----------------------------------------------------------------------------------------------------------------
    // @ Public Functions
    // -----------------------------------------------------------------------------------------------------------------
    public function toggleTaskStatus(GeneratedTask $generatedTask)
    {
        $generatedTask->update([
            'is_done' => !$generatedTask->is_done
        ]);
    }
    // -----------------------------------------------------------------------------------------------------------------
    // @ Private Functions
    // -----------------------------------------------------------------------------------------------------------------

    // -----------------------------------------------------------------------------------------------------------------
    // @ Render
    // -----------------------------------------------------------------------------------------------------------------
    
    public function render()
    {
        return view('livewire.tasks.task-listing');
    }
}