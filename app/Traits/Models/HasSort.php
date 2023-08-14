<?php

namespace App\Traits\Models;

trait HasSort
{
    public function scopeOrderBySort($query, $direction = 'asc')
    {
        $query->orderBy('sort', $direction);
    }

    public function scopeOrderBySortDesc($query)
    {
        $this->scopeOrderBySort($query, 'desc');
    }
}
