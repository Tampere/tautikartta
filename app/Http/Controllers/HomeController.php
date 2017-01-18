<?php

namespace App\Http\Controllers;

use App\Disease;

class HomeController extends Controller
{
    public function index()
    {
        $data = \DB::select( \DB::raw("SELECT date, gender, postcode, icd, count(id) as lkm from diseases WHERE date >= '20170101'  group by date, postcode, icd, gender;"));
//        $data = \DB::raw('SELECT date, gender, postcode, icd, count(id) as lkm from diseases group by date, postcode, icd, gender;');

        return view('welcome')
            ->with('data', $data);
    }

    public function show($id)
    {
        $date = '20160101';

        $data = \DB::select( \DB::raw("SELECT date, gender, icd, count(id) as lkm from diseases WHERE date >= :date AND postcode = :postcode group by date, postcode, icd, gender  order by date desc;"),
            array(
                'postcode' => $id,
                'date' => $date
            )
        );

        /*$icds = Disease::distinct()->select('icd')->where('date', '>=', $date)->where('postcode', $date)->get();*/

        return $data;
        /*return collect($data)->groupBy(['date'])->toArray();*/
    }
}
