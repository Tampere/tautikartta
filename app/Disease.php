<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    public static function monthlyCounts($id)
    {
        $data = self::selectRaw('month(date) month, agegroup, icd, count(id) as lkm');

        if($id != 'all') {
            $data->wherePostcode($id);
        }

        $data->where('date', '>=', '2016-01-01 00:00:00')
            ->where('date', '<=', '2016-12-31 59:59:59')
            ->groupBy('month', 'icd', 'agegroup')
            ->orderBy('date', 'desc');

        return $data->get();
    }
}
