<?php

namespace App\Http\Controllers;

use App\Disease;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function show($id)
    {
        return Disease::selectRaw('date, agegroup, postcode, icd, count(id) as lkm')
            ->where('postcode', $id)
            ->where('date', '>=', Carbon::createFromFormat('Y-m-d H:i:s', '2016-12-01 00:00:00'))
            ->groupBy('date', 'postcode', 'icd', 'agegroup')
            ->get();
    }

    public function icds($id)
    {
        return Disease::distinct()
            ->select('icd')
            ->where('postcode', $id)
            ->where('date', '>=', Carbon::createFromFormat('Y-m-d H:i:s', '2016-12-01 00:00:00'))
            ->get();
    }

    public function aggregates($id)
    {
        $data = Disease::selectRaw('year(date) year,	month(date) month, agegroup, icd, count(*) incidences')
            ->where('postcode', $id)
            ->where('date', '>=', Carbon::createFromFormat('Y-m-d H:i:s', '2016-12-01 00:00:00'))
            ->groupBy('icd', 'agegroup', 'year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->orderBy('agegroup', 'desc')
            ->get();

        return $data;
    }
}

//Disease::selectRaw('year(date) year, month(date) month, agegroup, icd, count(*) incidences')->where('postcode', 33100)->groupBy('icd', 'agegroup', 'year', 'month')->orderBy('year', 'desc')->orderBy('month', 'desc')->orderBy('agegroup', 'desc')->get();
