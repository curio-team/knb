<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BadgesController extends Controller
{
    public function index()
    {
        return \App\Badge::all();
    }

    public function show($id)
    {
        return \App\Badge::findOrFail($id);
    }

}
