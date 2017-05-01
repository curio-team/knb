<?php

namespace App\Http\Controllers;

use Session;
use App\Post;
use App\Tag;
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
        $tags = Tag::all();
        return view('posts/create')->with(compact('tags'));
    }

    public function answer(Post $post)
    {
        return view('posts.create-answer', [
            'post' => $post->load('author', 'author.houseRole', 'author.houseRole.house'),
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


        try
        {
            \DB::beginTransaction();
            $post = Post::create([
                'title' => $request->get('title'),
                'content' => $request->get('content'),
                'post_id' => $request->has('question_id') ? $request->get('question_id') : null,
                'author_id' => \Auth::id(),
            ]);

            if ($request->has('tag'))
            {
                $post->tags()->attach($request->get('tag'));
            }
            \DB::commit();
        } catch (\Exception $e)
        {
            \DB::rollback();
            return redirect()->back()->with('error', 'error creating post.');
        }


        $redirect = $request->has('question_id') ? $request->get('question_id') : $post->id;

        return redirect()->action('PostController@show', $redirect)->with('Success','Post succesfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return mixed
     */
    public function show(Post $post)
    {
        //handle views per post
        //TODO: there's gotta be a better place to put this...
        if (! Session::has('viewed')) {
            Session::put('viewed', []);
        }

        if (! in_array($post->id, Session::get('viewed'))) {
            Session::push('viewed', $post->id);
            Post::find($post->id)->increment('views');
        }

        $post = Post::with([
            'comments', 'comments.author', 'author', 'author.houseRole', 'author.houseRole.house', 'votes'
        ]);



        return view('posts.show', [
            'post' => $post,
            'replies' => Post::with('votes')->where('post_id', $post->id)
                ->orderBy('accepted_answer', 'DESC')
                ->orderBy('votes', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->get(),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return mixed
     */
    public function edit(Post $post)
    {
        return view('posts/edit', [
            'post' => $post->load('author', 'author.houseRole', 'author.houseRole.house', 'votes'),
            'tags' => Tag::all()
        ]);
    }

    /**
     *
     * Show form for editing answer
     *
     * @param  Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *
     */
    public function editAnswer(Post $post)
    {
        $post =  $post->load('author', 'author.houseRole', 'author.houseRole.house', 'votes');
        $tags =  Tag::all();
        return view('posts/edit-answer', compact('post', 'tags'));

    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Post $post
     * @return mixed
     */
    public function update(Request $request, Post $post)
    {
        $validation = [
            'title'   => 'required',
            'content' => 'required',
        ];
        $this->validate($request, $validation);

        try
        {
            \DB::beginTransaction();
            $post->update($request->all());
            if($request->has('tag'))
            {
                $post->tags()->detach();
                $post->tags()->attach($request->get('tag'));
            }
            \DB::commit();
        } catch(\Exception $e)
        {
            \DB::rollback();
            return redirect()->back()->with('error', 'Error editing post.: <br>' . $e->getMessage());
        }


        return redirect()->action('PostController@show', $post)->with('success', 'Succesfully edited your question.');

    }

    public function updateAnswer(Request $request, Post $post)
    {
        $validation = [
            'title'   => 'required',
            'content' => 'required',
        ];
        $this->validate($request, $validation);

        $post->update($request->all());
        return redirect()->action('PostController@show', $post->parent->id)->with('success', 'Succesfully edited your answer.');
    }

    /**
     * Accepts this as answer to question
     * @param Request $request
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept(Request $request, Post $post)
    {
        if (!$request->has('accepted')) {
            // Maybe show flash message here?
            return redirect()->back();
        }

        $this->validate($request, [
            'accepted' => 'boolean',
        ]);

        $post->update([
            'accepted_answer' => $request->get('accepted'),
        ]);

        return redirect()->back()->with('success', 'Answer has been accepted.');
    }


    public function vote(Request $request, Post $post)
    {

        if (!$request->has('vote'))
        {
            return redirect()->back()->with('fail', 'Error while voting.');
        }

        $this->validate($request, [
           'vote' => 'required|in:up,down'
        ]);

        $isUpvote = $request->get('vote') == 'up';

        if ($isUpvote) {
            $post->increment('votes');
        } else {
            $post->decrement('votes');
        }

        $post->votes()->create([
            'user_id' => auth()->id(),
            'vote' => $isUpvote ? 1 : -1,
        ]);

        return redirect()->back();
    }

    public function flag(Request $request, Post $post)
    {
        $post->increment('flags');


        return back();

    }


    public function filter(Request $request)
    {
        if (empty($request->tags))
        {
            return redirect()->action('HomeController@index');
        }
        $posts = Post::with('author')->
                whereHas('tags', function($query) use ($request){
                    $query->whereIn('tags.id', $request->tags);
                })->
                orderBy('created_at', 'DESC')->
                where('post_id', NULL)->
                paginate(10);

        return view('home', [
            'posts' => $posts,
            'searchTags' => $request->tags
        ]);
    }

    public function search(Request $request)
    {
        if (empty($request->get('query')))
        {
            return redirect()->action('HomeController@index');
        }
        $query = $request->get('query');
        $posts = Post::with('author')->
        orderBy('created_at', 'DESC')->
        where('post_id', NULL)->
        where('content', 'like', "%$query%")->
        orWhere('title', 'like', "%$query%")->
        paginate(10);


        return view('home', [
            'posts' => $posts,
            'query' => $request->get('query')
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return mixed
     */
    public function destroy(Post $post)
    {
        $post->delete();

    }
}
