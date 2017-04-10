<?php

namespace App\Http\Controllers;

use Session;
use App\Post;
use App\Vote;
use App\Comment;
use Illuminate\Http\Request;

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
            'posts' => Post::with('author')->orderBy('created_at', 'DESC')->where('post_id', NULL)->paginate(10)
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
        $post = Post::with('author', 'author.houseRole', 'author.houseRole.house')->findOrFail($id);

        return view('posts.create-answer', [
            'post' => $post,
        ]);
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
            'title'   => 'required',
            'content' => 'required',
        ];
        // if it's an answer to a question, validate question_id
        if ($request->has('answer')) {
            $validation['question_id'] = 'required|exists:post.id';
        }

        $this->validate($request, $validation);

        $post = Post::create([
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'post_id' => $request->has('question_id') ? $request->get('question_id') : null,
            'author_id' => \Auth::id(),
        ]);

        $redirect = $request->has('question_id') ? $request->get('question_id') : $post->id;

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
        //handle views per post
        //TODO: there's gotta be a better place to put this...
        if (! Session::has('viewed')) {
            Session::put('viewed', []);
        }

        if (! in_array($id, Session::get('viewed'))) {
            Session::push('viewed', $id);
            Post::find($id)->increment('views');
        }

        $post = Post::with([
            'comments', 'comments.author', 'author', 'author.houseRole', 'author.houseRole.house', 'votes'
        ]);



        return view('posts.show', [
            'post' => $post->findOrFail($id),
            'replies' => Post::with('votes')->where('post_id', $id)
                ->orderBy('accepted_answer', 'DESC')
                ->orderBy('votes', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->get(),
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
        return view('posts/edit', [
            'post' => Post::with('author', 'author.houseRole', 'author.houseRole.house', 'votes')->findOrFail($id)
        ]);
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
        $validation = [
            'title'   => 'required',
            'content' => 'required',
        ];
        $this->validate($request, $validation);

        Post::findOrFail($id)->update($request->all());
        return redirect()->back();

    }

    /**
     * Accepts this as answer to question
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept(Request $request, $id)
    {
        if (!$request->has('accepted')) {
            // Maybe show flash message here?
            return redirect()->back();
        }

        $this->validate($request, [
            'accepted' => 'boolean',
        ]);

        Post::find($id)->update([
            'accepted_answer' => $request->get('accepted'),
        ]);

        return redirect()->back();
    }


    public function vote(Request $request, $id)
    {

        if (!$request->has('vote'))
        {
            return redirect()->back()->with('fail', 'Error while voting.');
        }

        $this->validate($request, [
           'vote' => 'required|in:up,down'
        ]);

        $data = [
            'user_id' => \Auth::user()->id,
            'post_id' => $id
        ];
        if ($request->get('vote') == 'up')
        {
             $data['vote'] = 1;
            Post::find($id)->increment('votes');
        } else
        {
            $data['vote'] = -1;
            Post::find($id)->decrement('votes');
        }

        Vote::create($data);

        return redirect()->back();
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
