<?php

namespace App\Http\Controllers;

use App\Post;
use GrahamCampbell\GitHub\GitHubManager;
use Illuminate\Http\Request;
use GitHub;

class HomeController extends Controller
{
    private $github;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(GitHubManager $github)
    {
        $this->middleware('auth');
        $this->github = $github;
    }

    /*
     * Show the applications home
     *
     *
     */
    public function index()
    {

        $news = \App\News::all()->sortByDesc('created_at');
        return view('home', [
            'news' => $news,

        ]);
    }

    /**
     * Show the application forum.
     "
     * @return \Illuminate\Http\Response
     */
    public function forum()
    {

        if (\Auth::user()->isHeadMaster() || \Auth::user()->isEditor())
        {
            $posts = Post::with('author')->orderBy('created_at', 'DESC')->where('post_id', NULL)->paginate(10);
        } else {
            $posts = Post::with('author')->orderBy('created_at', 'DESC')->where('post_id', NULL)->where('flags',"!=","3")->paginate(10);
        }
        

        return view('forum', [
            'posts' => $posts,

        ]);
    }

    public function about()
    {
        return view('about');
    }

    public function learn()
    {
        return view('learn/index');
    }

    public function gameInfo()
    {
        $badges = \App\Badge::orderBy('priority')->get();
        $score_types = \App\ScoreType::orderBy('points')->get();
        return view('gameinfo', compact(['badges', 'score_types']));
    }


    public function details($tag)
    {
        return view('learn/detail', [
            'tag' => $tag
        ]);
    }

    public function badgeRequest() {

        $badges = \App\Badge::all();
        return view('request-badge', compact('badges'));

    }

}
