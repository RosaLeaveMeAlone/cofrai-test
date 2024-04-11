<?php

namespace App\Http\Traits;

use Livewire\WithPagination;

trait WithTable
{
    use WithPagination;
    use WithSearch;
    use WithSorting;
}
