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
     * @return \Illuminate\Http\Response
     */
    public function __construct(GitHubManager $github)
    {
        $this->middleware('auth');
        $this->github = $github;
    }

    /**
     * index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $news = \App\News::all()->sortByDesc('created_at');
        return view('home', [
            'news' => $news,

        ]);
    }

    /**
     * forum
     *
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

    /**
     * about
     *
     * @return \Illuminate\Http\Response
     */
    public function about()
    {
        return view('about');
    }

    /**
     * learn
     *
     * @return \Illuminate\Http\Response
     */
    public function learn()
    {
        return view('learn/index');
    }

    /**
     * gameInfo
     *
     * @return \Illuminate\Http\Response
     */
    public function gameInfo()
    {
        $badges = \App\Badge::orderBy('priority')->get();
        $score_types = \App\ScoreType::orderBy('points')->get();
        return view('gameinfo', compact(['badges', 'score_types']));
    }


    /**
     * details
     *
     * @param mixed $tag
     * @return \Illuminate\Http\Response
     */
    public function details($tag)
    {
        return view('learn/detail', [
            'tag' => $tag
        ]);
    }

    /**
     * badgeRequest
     *
     * @return \Illuminate\Http\Response
     */
    public function badgeRequest() {

        $badges = \App\Badge::all();
        return view('request-badge', compact('badges'));

    }

}
