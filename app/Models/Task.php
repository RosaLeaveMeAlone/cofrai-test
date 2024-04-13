<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

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
    
    // -----------------------------------------------------------------------------------------------------------------
    // @ Accessors & Mutators
    // -----------------------------------------------------------------------------------------------------------------

    // -----------------------------------------------------------------------------------------------------------------
    // @ Public Functions
    // -----------------------------------------------------------------------------------------------------------------

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
