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

        if ($search) {
            $query->where(
                fn ($query) => $query
                    ->where('tasks.title', 'ILIKE', "%$search%")
                    ->orWhere('tasks.description', 'ILIKE', "%$search%")
                    // ->orWhere('tasks.description', 'ILIKE', "%$search%")
                    ->orWhere('tasks.frequency', 'ILIKE', "%$search%")
            );
        }

        if($userId) {
            $query->where('user_id', $userId);
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
