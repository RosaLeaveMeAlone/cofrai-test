<?php

namespace App\Http\Traits;

trait WithSorting
{
    public $sortByAttribute = 'id';

    public $sortByStatus = '';

    public $sortByType = '';

    public $sortDirection = 'DESC';

    public function sortBy($value)
    {
        if ($value != $this->sortByAttribute || $this->sortDirection == 'DESC') {
            $this->sortDirection = 'ASC';
        } else {
            $this->sortDirection = 'DESC';
        }

        $this->sortByAttribute = $value;
    }

    public function getSortStateProperty()
    {
        return [
            'sort_by' => $this->sortByAttribute,
            'direction' => $this->sortDirection,
        ];
    }

    public function getHandleNullsProperty()
    {
        return $this->sortDirection == 'DESC' ? 'NULLS LAST' : 'NULLS FIRST';
    }
}
