<?php

namespace App\Http\Controllers;

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

        $data = \DB::select( \DB::raw("SELECT date, gender, postcode, icd, count(id) as lkm from diseases WHERE date >= '20160101' AND postcode = :postcode group by date, postcode, icd, gender;"),
            array(
                'postcode' => $id,
            )
        );

        return $data;
    }
}
