<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $flagged = \App\Post::getFlaggedPosts();
        return view('dashboard/index', compact('flagged'));
    }

    public function import()
    {
        return view('dashboard/import');
    }
}
