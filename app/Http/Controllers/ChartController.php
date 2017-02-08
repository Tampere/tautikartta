<?php

namespace App\Http\Controllers;

use App\Disease;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function index()
    {
        $data = Disease::distinct('postcode')
            ->orderBy('postcode')
            ->get(['postcode']);

        return view('chart.list')
            ->with('data', $data);
    }

    public function show($id)
    {
        /*$start = Carbon::createFromFormat('Y-m-d H:i:s', '2016-01-01 00:00:00');
        $end = Carbon::createFromFormat('Y-m-d H:i:s', '2016-12-31 59:59:59');*/

        $data = Disease::selectRaw('month(date) month, agegroup, icd, count(id) as lkm')
            ->wherePostcode($id)
            ->where('date', '>=', '2016-01-01 00:00:00')
            ->where('date', '<=', '2016-12-31 59:59:59')
            ->groupBy('month', 'icd', 'agegroup')
            ->orderBy('date', 'desc')
            ->get();

        if($data->count() < 1) {
            return 'Ei dataa valitulla postinumerolla.';
        }

        $arr = [];
        foreach($data as $row) {
            $arr[$row->icd][$row->month][$row->agegroup] = $row->lkm;
        }

        return view('chart.show')
            ->with('postcode', $id)
            ->with('data', $arr);
    }
}
