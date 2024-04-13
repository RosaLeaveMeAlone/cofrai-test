<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneratedTask extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'date',
        'is_done',
        'task_id',
    ];

    // -----------------------------------------------------------------------------------------------------------------
    // @ Relations
    // -----------------------------------------------------------------------------------------------------------------
    public function task()
    {
        return $this->belongsTo(Task::class);
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
}