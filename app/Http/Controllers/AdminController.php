<?php

namespace App\Http\Controllers;

use App\Warning;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $warning = Warning::first();
        return view('admin')
            ->with('warning', $warning);
    }

    public function store(Request $request)
    {
        $warning = Warning::first();

        if(!$warning) {
            $warning = Warning::create(['text' => $request->varoitus]);
        } else {
            $warning->text = $request->varoitus;
            $warning->save();
        }

        return back()
            ->with('status', 'Tiedot tallennettu.');
    }
}
