<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Comment;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return mixed
     */
    public function index()
    {
        return view('posts.index')->with([
            'posts' => Post::with('author')->orderBy('created_at', 'DESC')->where('post_id', NULL)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return mixed
     */
    public function create()
    {
        return view('posts/create');
    }

    public function answer($id)
    {
        $postDetails = ['author', 'author.houseRole', 'author.houseRole.house'];

        return view('posts.create-answer')->with([
            'post' => Post::with($postDetails)->findOrFail($id)]);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    public function store(Request $request)
    {

        $validation = [
            'title'       => 'required',
            'content'     => 'required'
        ];
        // if it's an answer to a question, validate question_id
        if (isset( $request->answer ) )
        {
            $validation['question_id'] = 'required|exists:post.id';
        }

        $this->validate($request, $validation);

        $post = new \App\Post();
        $post->title    = $request->title;
        $post->content  = $request->content;

        // only set question_id if it's an answer to question
        isset($request->question_id) ? $post->post_id  = $request->question_id : false;

        $post->author_id   = \Auth::user()->id;

        $post->save();

        $redirect = isset($request->question_id) ? $request->question_id : $post->id;

        return redirect()->action('PostController@show', $redirect);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return mixed
     */
    public function show($id)
    {
        $postDetails = ['comments', 'comments.author', 'author', 'author.houseRole', 'author.houseRole.house'];

        return view('posts.show')->with([
            'post' => Post::with($postDetails)->findOrFail($id),
            'replies' => Post::with($postDetails)->where('post_id', $id)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return mixed
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
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return mixed
     */
    public function destroy($id)
    {
        //
    }
}
