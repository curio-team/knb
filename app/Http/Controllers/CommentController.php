<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateCommentRequest;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param CreateCommentRequest       $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCommentRequest $request)
    {
        $comment = new \App\Comment();

        $comment->author_id = \Auth::user()->id;
        $comment->post_id = $request->post_id;
        $comment->content = $request->get('content');
        $comment->save();

        if (! $comment->post->isYours())
        {
            \App\Point::assign(\Auth::user()->id, \App\Point::BENEFACTOR_TYPE_COMMENTED);
            \Auth::user()->addPoints(\App\Point::BENEFACTOR_TYPE_COMMENTED, true);
        }

        return redirect()->back()->with('success', 'Succesfully added comment!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Comment $comment)
    {
        $comment->delete();
        \App\Point::deAssign($comment->author()->id,\App\Point::BENEFACTOR_TYPE_COMMENTED );
        $comment->author()->deletePoints(\App\Point::BENEFACTOR_TYPE_COMMENTED, true);
    }
}
