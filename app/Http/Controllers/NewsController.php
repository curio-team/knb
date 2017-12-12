<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\News::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(\Auth::user()->type != 'teacher' && \Auth::user()->type != 'editor')
        {
            return back();
        }
        $news = new \App\News();
        $news->title    = $request->get('title');
        $news->content  = $request->get('content');
        $news->sticky   = $request->get('sticky');
        $news->save();
        return back()->with('success', 'Newsitem created succesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $newsItem = \App\News::find($id);
        return view('news/show', compact('newsItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(\Auth::user()->type != 'teacher' && \Auth::user()->type != 'editor')
        {
            return back();
        }
        $news = \App\News::find($id);
        if (\Auth::user()->type != 'teacher' && \Auth::user()->type != 'editor')
        {
            return back();
        }
        return view('news/edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(\Auth::user()->type != 'teacher' && \Auth::user()->type != 'editor')
        {
            return back();
        }
        $news = \App\News::find($id);
        $news->title    = $request->get('title');
        $news->content  = $request->get('content');
        $news->sticky   = 0;
        $news->save();
        return redirect()->action('NewsController@show', $id)->with('success', 'Newsitem updated succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function all()
    {
        return \App\News::orderBy('created_at', 'desc')->get();
    }

}
