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
        $comment = \App\Comment::find($id);
        if (($comment->author->id !== \Auth::user()->id && ($comment->post->isLocked() || $comment->flags == 1)) && \Auth::user()->type != 'teacher' && \Auth::user()->type != 'editor'){
            return redirect()->back()->with('error', 'Error editing comment.');
        }

        $comment->content = $request->content;
        $comment->save();

        return redirect()->back()->with('success', 'Succesfully editing comment!');
    }

    /**
     * Update flags form user and comment as flagged
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function flag(Request $request, $id)
    {
        $comment = \App\Comment::find($id);
        if (!$comment->isFlagged())
        {
            $comment->increment('flags');

            $user = \Auth::user();
            $user->commentFlags()->attach($comment->id, ['reason' => $request->get('reason') == null ? "no reason given" : $request->get('reason')]);
        }
        return back();
    }

    /**
     * Update flags form user and comment as flagged
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function unflag(Request $request, $id)
    {
        $comment = \App\Comment::find($id);
        if (!$comment->isFlagged())
        {
            $comment->increment('flags');

            $user = \Auth::user();
            $user->commentFlags()->attach($comment->id, ['reason' => $request->get('reason') == null ? "no reason given" : $request->get('reason'), "action" => 0]);
        }
        return back();
    }

    /**
     * Update flags form user and comment as flagged
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request, $id)
    {
        $comment = \App\Comment::find($id);
        if ($comment->flags == 1){
            $comment->increment('flags');
            $user = Auth::user();
            $user->commentFlags()->attach($comment->id, ["reason" => $request->get('reason') == null ? "no reason given" : $request->get('reason'), "action" => 2, "add_flag_id" => $request->get('flag_id')]);
        }
        return back();
    }
    /**
     * Update flags form user and comment as flagged
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removal(Request $request, $id)
    {
        $comment = \App\Comment::find($id);
        if ($comment->flags == 1 || $comment->flags == 3){
            $comment->flags = ($comment->flags == 1) ? 3 : 1;
            $comment->save();
            $user = Auth::user();
            $user->commentFlags()->attach($comment->id, ["reason" => $request->get('reason') == null ? "no reason given" : $request->get('reason'), "action" => $comment->flags, "add_flag_id" => $request->get('flag_id')]);
        }
        return back();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Comment $comment)
    {

        if ( \Auth::user()->type != 'teacher'){
            return redirect()->back()->with('error', 'Your are not allow to delete posts');
        }

        $comment->delete();
        \App\Point::deAssign($comment->author()->id,\App\Point::BENEFACTOR_TYPE_COMMENTED );
        $comment->author()->deletePoints(\App\Point::BENEFACTOR_TYPE_COMMENTED, true);
        return redirect()->back()->with('success', 'the post has now been deleted.');
    }
}
