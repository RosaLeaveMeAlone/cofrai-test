<?php

namespace App\Http\Traits;

trait WithSearch
{
    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function setSearch($model, $text)
    {
        $this[$model] = $text;
    }
}
