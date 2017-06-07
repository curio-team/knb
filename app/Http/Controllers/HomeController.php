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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('author')->orderBy('created_at', 'DESC')->where('post_id', NULL)->paginate(10);

        return view('home', [
            'posts' => $posts,

        ]);
    }

    public function learn()
    {
        return view('learn/index');
    }

    public function details($tag)
    {
        return view('learn/detail', [
            'tag' => $tag
        ]);
    }

    public function dashboard()
    {
        return 'dashboard';
    }

    public function profile()
    {
        return 'profile';
    }

}
