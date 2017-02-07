<?php

namespace App\Http\Controllers;

use App\Disease;

class HomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function show($id)
    {
        return Disease::selectRaw('date, gender, postcode, icd, count(id) as lkm')
            ->where('postcode', $id)
            ->groupBy('date', 'postcode', 'icd', 'gender')
            ->get();
    }

    public function icds($id)
    {
        return Disease::distinct()
            ->select('icd')
            ->where('postcode', $id)
            ->get();
    }

    public function aggregates($id)
    {
        $data = Disease::selectRaw('year(date) year,	month(date) month, gender, icd, count(*) incidences')
            ->where('postcode', $id)
            ->groupBy('icd', 'gender', 'year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->orderBy('gender', 'desc')
            ->get();

        /*$data = $data->groupBy('year');

        $data = $data->map(function($item) {
            return $item->groupBy('month');
        });*/

        return $data;
    }
}

//Disease::selectRaw('year(date) year, month(date) month, gender, icd, count(*) incidences')->where('postcode', 33100)->groupBy('icd', 'gender', 'year', 'month')->orderBy('year', 'desc')->orderBy('month', 'desc')->orderBy('gender', 'desc')->get();
