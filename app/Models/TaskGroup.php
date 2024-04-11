<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    // -----------------------------------------------------------------------------------------------------------------
    // @ Relations
    // -----------------------------------------------------------------------------------------------------------------
    public function user()
    {
        return $this->belongsTo(User::class);
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
                    ->where('task_groups.name', 'ILIKE', "%$search%")
                    ->orWhere('task_groups.description', 'ILIKE', "%$search%")
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
