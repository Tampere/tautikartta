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
        $data = Disease::monthlyCounts($id);

        if($data->count() < 1) {
            return 'Ei dataa valitulla postinumerolla.';
        }

        $arr = [];
        foreach($data as $row) {
            $arr[$row->icd][$row->month][$row->agegroup] = $row->lkm;
        }

        return view('chart.show')
            ->with('postcode', $id)
            ->with('data', $arr)
            ->with('max', $data->max('lkm'));
    }
}
