<?php
// app/Trait/GlobalScopesTrait.php

namespace App\Traits;

trait GlobalScopesTrait
{
    public function scopeWhereIf($query, $col, $operator, $val)
    {
        if ($val) {
            if ($operator === 'LIKE') {
                $query->where($col, 'LIKE', '%' . $val . '%');
            } elseif ($operator === '=') {
                $query->where($col, '=', $val);
            }
        }
        return $query;
    }
    public function scopeOrWhereIf($query, $col, $operator, $val)
    {
        if ($val) {
            if ($operator === 'LIKE') {
                $query->orWhere($col, 'LIKE', '%' . $val . '%');
            } elseif ($operator === '=') {
                $query->orWhere($col, '=', $val);
            }
        }
        return $query;
    }

    public function scopeFilterByCreatedDateRange($query, $dateFrom, $dateTo)
    {

        if (($dateFrom === $dateTo) && ($dateFrom && $dateTo)) {
            return $query->whereDate('created_at', '=', $dateFrom);
        } elseif ($dateFrom && $dateTo) {
            // Add one day to the end date
            $endDate = date('Y-m-d', strtotime($dateTo . ' +1 day'));

            return $query->whereBetween('created_at', [$dateFrom, $endDate]);
        } elseif ($dateFrom) {
            return $query->where('created_at', '>=', $dateFrom);
        } elseif ($dateTo) {
            // Add one day to the end date
            $endDate = date('Y-m-d', strtotime($dateTo . ' +1 day'));

            return $query->where('created_at', '<=', $endDate);
        }
        return $query;
    }


    public function scopeFilterByDateRange($query, $dateFrom, $dateTo)
    {
        if ($dateFrom && $dateTo) {
            return $query->whereBetween('date', [$dateFrom, $dateTo]);
        } elseif ($dateFrom) {
            return $query->where('date', '>=', $dateFrom);
        } elseif ($dateTo) {
            return $query->where('date', '<=', $dateTo);
        }
    }
}
