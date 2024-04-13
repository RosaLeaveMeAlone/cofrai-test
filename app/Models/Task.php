<?php

namespace App\Models;

use App\Http\Services\DateService;
use App\Observers\TaskObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy([TaskObserver::class])]
class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'description',
        'frequency',
        'repetitions',
        'start_date',
        'end_date',
        'task_group_id',
        'user_id',
    ];

    // -----------------------------------------------------------------------------------------------------------------
    // @ Relations
    // -----------------------------------------------------------------------------------------------------------------
    public function taskGroup()
    {
        return $this->belongsTo(TaskGroup::class);
    }

    public function generatedTasks()
    {
        return $this->hasMany(GeneratedTask::class);
    }
    
    // -----------------------------------------------------------------------------------------------------------------
    // @ Accessors & Mutators
    // -----------------------------------------------------------------------------------------------------------------

    // -----------------------------------------------------------------------------------------------------------------
    // @ Public Functions
    // -----------------------------------------------------------------------------------------------------------------
    public function createGeneratedTasks()
    {
        if ($this->repetitions) {
            $dates = DateService::getDatesFromIteration($this->frequency, $this->repetitions);
        } else {
            $dates = DateService::getDatesFromDateRange($this->frequency, $this->start_date, $this->end_date);
        }
        foreach ($dates as $date) {
            $this->generatedTasks()->create([
                'date' => $date,
            ]);
        }
    }
    // -----------------------------------------------------------------------------------------------------------------
    // @ Private Functions
    // -----------------------------------------------------------------------------------------------------------------

    // -----------------------------------------------------------------------------------------------------------------
    // @ Static Functions
    // -----------------------------------------------------------------------------------------------------------------
    public static function filter(
        $search = null,
        $orderByAttribute = 'id',
        $orderByDirection = 'ASC',
        $userId = null,
    ) {
        $query = static::query();

        $query->select('tasks.*', 'task_groups.name as task_group_name');

        if ($search) {
            $query->where(
                fn ($query) => $query
                    ->where('tasks.title', 'ILIKE', "%$search%")
                    ->orWhere('tasks.description', 'ILIKE', "%$search%")
                    ->orWhere('tasks.repetitions', 'ILIKE', "%$search%")
                    ->orWhere('tasks.start_date', 'ILIKE', "%$search%")
                    ->orWhere('tasks.end_date', 'ILIKE', "%$search%")
            );
        }

        $query->leftJoin('task_groups', 'tasks.task_group_id', '=', 'task_groups.id');

        if($userId) {
            $query->where('tasks.user_id', $userId);
        }

        // sorting
        $handleNulls = strtoupper($orderByDirection) == 'DESC' ? 'NULLS LAST' : 'NULLS FIRST';
        switch ($orderByAttribute) {
            default:
                $query->orderByRaw("$orderByAttribute $orderByDirection $handleNulls");
                break;
        }

        return $query;
    }
}
