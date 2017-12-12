<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if (empty($request->get('query')))
        {
            return redirect()->action('HomeController@forum');
        }
        $query = $request->get('query');
        $posts = Post::with('author')->
        orderBy('created_at', 'DESC')->
        whereRaw("`post_id` is NULL and `post_id` is null and (`content` like '%$query%' or `title` like '%$query%')")->paginate(10);
        /*where('post_id', NULL)->
        where('content', 'like', "%$query%")->
        orWhere('title', 'like', "%$query%")->
        paginate(10);*/

        return view('forum', [
            'posts' => $posts,
            'query' => $request->get('query')
        ]);
    }
}
