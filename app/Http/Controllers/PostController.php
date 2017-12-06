<?php

namespace App\Http\Controllers;

use App\Http\Requests\AcceptAnswerRequest;
use App\Http\Requests\AddVoteRequest;
use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Http\Requests\UpdatePostRequest;
use Session;
use App\Post;
use App\Tag;
use App\Message;
use Illuminate\Http\Request;
use Auth;

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

    public function lock(Post $post)
    {

        $post->locked = $post->isLocked() ? 0 : 1;
        $post->save();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreatePostRequest $request
     * @return mixed
     */
    public function store(CreatePostRequest $request)
    {
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

            // get points for an answer but not on your own question
            if ($post->isAnswer() )
            {
                 // we don't want to assign points when answering your own question.
                if ($post->parent->author_id !== \Auth::user()->id )
                {
                    $type = \App\Point::BENEFACTOR_TYPE_QUESTION_ANSWERED;
                    \App\Point::assign(\Auth::user()->id, $type);
                    \Auth::user()->addPoints($type, true);

                }
            // get points for a question
            } else {
                $type = \App\Point::BENEFACTOR_TYPE_QUESTION_ASKED;
                \App\Point::assign(\Auth::user()->id, $type);
                \Auth::user()->addPoints($type, true);
            }
            // assign the points
            \DB::commit();

        } catch (\Exception $e)
        {
            \DB::rollback();
            return redirect()->back()->with('error', 'error creating post.');
        }
        $warning = false;
        try {

            if ($post->isAnswer())
            {
                $email = $post->parent->author->email;
                \Mail::to($email)
                ->send(new \App\Mail\PostAnswered($post->parent));
            }
            
        } catch (\Exception $e){
            $warning = true;
        }


        $redirect = $request->has('question_id') ? $request->get('question_id') : $post->id;

        return redirect()->action('PostController@show', $redirect)->with(($warning) ? 'error' : 'Success', ($warning) ? 'Post succesfully created, but there was an exception' : 'Post succesfully created.');
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
        if (! Session::has('viewed')) {
            Session::put('viewed', []);
        }

        if (! in_array($post->id, Session::get('viewed'))) {
            Session::push('viewed', $post->id);
            Post::find($post->id)->increment('views');
        }

    //        $post = Post::with([
    //            'comments', 'comments.author', 'author', 'author.houseRole', 'author.houseRole.house', 'votes'
    //        ])->get();
    //        dd($post);
        while ($post->isAnswer() > 0){
            $post = $post->parent;
        }

        return view('posts.show', [
            'post' => $post,
            'replies' => Post::with('votes')->where('post_id', $post->id)
                ->orderBy('accepted_answer', 'DESC')
                ->orderBy('created_at', 'DESC')
                ->orderBy('votes', 'DESC')
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
        if (($post->author->id !== \Auth::user()->id && ($post->flags == 1 || $post->flags == 3 || $post->isLocked())) && \Auth::user()->type != 'teacher' && \Auth::user()->type != 'editor')
        {
            return back();
        }
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

     * @param UpdatePostRequest $request
     * @param  int $id
     * @return mixed
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);

        if (($post->author->id !== \Auth::user()->id && ($post->isLocked() || $post->flags == 1)) && \Auth::user()->type != 'teacher' && \Auth::user()->type != 'editor'){
            return redirect()->back()->with('error', 'Error editing post.: <br>' . $e->getMessage());
        }

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

        if ($post->flags == 2){
            $post->flags = 0;
            $post->save();
            $user = Auth::user();
            $user->flags()->detach($post->id);
            $user->flags()->detach($post->id);
        }

        if ($post->parent)
        {
            return redirect()->action('PostController@show', $post->parent->id)->with('success', 'Succesfully edited your question.');
        } else {
            return redirect()->action('PostController@show', $post->id)->with('success', 'Succesfully edited your question.');
        }

    }


    public function updateAnswer(UpdateAnswerRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return redirect()->action('PostController@show', $post->parent->id)->with('success', 'Succesfully edited your answer.');
    }

    /**
     * Accepts this as answer to question

     * @param AcceptAnswerRequest $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function accept(AcceptAnswerRequest $request, $id)
    {
        $accepted = $request->get('accepted');

        $post = Post::find($id);
        $post->update([
            'accepted_answer' => $accepted,
        ]);

        if( $accepted ){

            // accepted answer author gets points.
            if ( \Auth::user()->id !== $post->author_id)
            {
                \App\Point::assign($post->author_id, \App\Point::BENEFACTOR_TYPE_ANSWER_ACCEPTED);
                $post->author->addPoints(\App\Point::BENEFACTOR_TYPE_ANSWER_ACCEPTED, true);
            }
            $message = 'Answer has been accepted.';
        }else{

            if ( \Auth::user()->id !== $post->author_id)
            {
                \App\Point::deAssign($post->author_id, \App\Point::BENEFACTOR_TYPE_ANSWER_ACCEPTED);
                $post->author->deletePoints(\App\Point::BENEFACTOR_TYPE_ANSWER_ACCEPTED, true);
            }
            $message = 'Accepted answer is undone.';
        }

        return redirect()->back()->with('success', $message);
    }

    public function vote(AddVoteRequest $request,Post $post)
    {
        $data = [
            'user_id' => \Auth::user()->id,
            'post_id' => $post->id
        ];

             $data['vote'] = 1;
            $post->increment('votes');

        $post->votes()->create([
            'user_id' => auth()->id(),
            'vote' => 1,
        ]);

        return redirect()->back();
    }

    public function flag(Request $request, Post $post)
    {
        if (!$post->isFlagged())
        {
            $post->increment('flags');
            $post->update(['flags' => 2]);
            $user = Auth::user();
            $user->flags()->attach($post->id);
        }
        return back();
    }

    public function unflag(Request $request, Post $post)
    {
        if ($post->flags == 1)
        {
            $post->decrement('flags');
        $user = Auth::user();
        $user->flags()->detach($post->id);
        }
        
        return back();
    }

    public function change(Request $request, Post $post)
    {
        if ($post->flags == 1){
            $post->increment('flags');
            $user = Auth::user();
            $user->flags()->attach($post->id);
        }
        return back();
    }

    public function removal(Request $request, Post $post)
    {
        if ($post->flags == 1 || $post->flags == 3){
            $post->flags = ($post->flags == 1) ? 3 : 1;
            $post->save();
            $user = Auth::user();
            $user->flags()->attach($post->id);
        }
        return back();
    }

    public function filter(Request $request)
    {
        if (empty($request->tags))
        {
            return redirect()->action('HomeController@forum');
        }

        $posts = Post::with('author')->
            whereHas('tags', function($query) use ($request){
                $query->whereIn('tags.id', $request->tags);
            })->
            orderBy('created_at', 'DESC')->
            where('post_id', NULL)->
            paginate(10);

        return view('forum', [
            'posts' => $posts,
            'searchTags' => $request->tags
        ]);
    }

    public function search(Request $request)
    {
        if (empty($request->get('query')))
        {
            return redirect()->action('HomeController@forum');
        }
        $query = $request->get('query');
        $user_id = Auth::user()->id;
        $posts = Post::with('author')->
        orderBy('created_at', 'DESC')->
        whereRaw("`post_id` is NULL and (`flags` < '2' or `author_id` like '$user_id') and (`content` like '%$query%' or `title` like '%$query%')")->paginate(10);

      $users = \App\User::whereRaw("`name` like '%$query%' or  `id` like '%query%'")->get();


        return view('forum', [
            'posts' => $posts,
            'users' => $users,
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

        // check whether post was an answer for determining the point type.
        $type = $post->isAnswer() ? \App\Point::BENEFACTOR_TYPE_QUESTION_ANSWERED : \App\Point::BENEFACTOR_TYPE_QUESTION_ASKED;

        $author_id = $post->author_id;
        $body = $post->content;
        \App\Point::deAssign($post->author_id, $type);
        $post->author->deletePoints($type, true);
        $post->children()->delete();
        $post->delete();

        try
        {
            \DB::beginTransaction();

            $message = new Message;
            $message->sender_id = \Auth::id();
            $message->receiver_id = $author_id;
            $message->subject = 'Your post or answer has been removed!';
            $message->content = 'Please follow our guidelines: do not spam, be specific and only give useful answers. Just a link is never a useful answer! This concerns the following message:';
            $message->content .= $body;
            $message->save();

            // create the message
            \DB::commit();
        } catch (\Exception $e)
        {
            \DB::rollback();
            return redirect()->back()->with('error', 'Error creating message.' . var_export($e->getMessage(), true));
        }

    }
}
