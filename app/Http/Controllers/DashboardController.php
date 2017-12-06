<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{

    /**
     * index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flagged = \App\Post::getFlaggedPosts();
        return view('dashboard/index', compact('flagged'));
    }

    /**
     * import
     *
     * @return \Illuminate\Http\Response
     */
    public function import()
    {
        return view('dashboard/import');
    }

    /**
     * points
     *
     * @return \Illuminate\Http\Response
     */
    public function points()
    {
        $students = \App\User::getStudents();
        return view('dashboard/points', compact('students'));
    }

    /**
     * badges
     *
     * @return \Illuminate\Http\Response
     */
    public function badges()
    {
        $badges = \App\Badge::all();
        return view('dashboard/badges', compact('badges'));
    }

    /**
     * news
     *
     * @return \Illuminate\Http\Response
     */
    public function news()
    {
        $news = \App\News::all();
        return view('dashboard/news', compact('news'));
    }

}
