<div class="content">
    @if(\Request::path() == 'post/search')
        <p>You've searched for: <b>{{ $query }}</b>. (<a href="{{ action('HomeController@index') }}">reset</a>)</p>
    @endif

    <h1> Questions </h1>

    <div class="posts" >

        @if(!count($posts))
            <div class="box">
                <p>Whelp, there aren't any posts right now, how about you go fix that?!</p>
            </div>

        @endif

        @foreach($posts as $post)
            <div class="box box-post box-with-options" data-href="{{ action('PostController@show', $post) }}">
                <div class="box-options">
                    @if(\Auth::user()->isHeadMaster() || \Auth::user()->isEditor())
                        @include("partials/minis/_post-admin-controls")
                    @endif
                    @unless($post->isLocked())
                        @if($post->isYours() ||(\Auth::user()->isHeadMaster() || \Auth::user()->isEditor()))
                            @if(!$post->isFlagged() || ((\Auth::user()->isHeadMaster() || \Auth::user()->isEditor()) && !$post->isYours() ) )
                                <a href="{{ action('PostController@edit', $post) }}" class="option-edit">
                                    <i title="edit this post" class="fa fa-2x fa-edit"></i>
                                </a>
                            @else
                                @if($post->flags == 2)
                                    <a href="{{ action('PostController@edit', $post) }}" class="option-edit">
                                        <i title="you should edit this post" class="fa fa-2x fa-edit" style="color: #ff6600"></i>
                                    </a>
                                @endif
                            @endif
                        @endif

                        @unless($post->author->isHeadmaster())
                            @unless($post->isFlagged())
                                <i class="option-flag">
                                    <i title="flag this post" class="fa fa-2x fa-flag"></i>
                                </i>

                                <form class="flag-form" style="display:none" action="{{ action('PostController@flag', $post) }}" method="POST">
                                    {{ csrf_field() }}
                                </form>
                            @else
                                @if($post->flags == 1)
                                    <i title="this post is flagged. A moderator will look into this soon." class="fa fa-2x fa-flag" style="color: red"></i>
                                @else
                                    @if( !$post->isYours() && $post->flags == 2)
                                        <i title="this post should be edit by the author, an editor or a headmaster." class="fa fa-2x fa-edit" style="color: yellow"></i>
                                    @endif
                                @endif
                            @endunless
                        @endunless
                    @else
                        <i title="This post is locked. You can not comment or answer this post" class="fa fa-2x fa-lock" style="color: red"></i>
                    @endunless

                    
                </div>

                <article class="media" >
                    <figure class="media-left">
                        <p class="image is-64x64">
                            <img src="{{ $post->author->houserole->house->thumbnail()  }}">
                        </p>

                    </figure>

                    <div class="media-content">
                        <div class="content">
                            <p>
                                @if($post->author->isHeadmaster())
                                    author: <span style="text-shadow: 0px 0px 3px black; color: gold" class="author"> {{ $post->author->name }}</span>
                                @else
                                    @if($post->author->isEditor())
                                        author: <span style="text-shadow: 0px 0px 3px black; color: silver" class="author"> {{ $post->author->name }}</span>
                                    @else
                                        <span class="author">author: {{ $post->author->name }}</span>
                                    @endif
                                @endif

                                <br>
                                <a href="{{ action('PostController@show', $post) }}">{{ $post->title }}</a>
                            </p>

                        </div>
                        <div class="block">
                            <a href="{{ action('PostController@show', $post) }}" class="button">{{ $post->views }} {{ str_plural('view', $post->views) }}</a>
                            <a href="{{ action('PostController@show', $post) }}" class="button {{ $post->isAccepted() ? 'is-success' : '' }}">
                                @unless($post->isAccepted())
                                    {{ $post->getAnswerTotal() }} {{ str_plural('answer', $post->getAnswerTotal()) }}
                                @else
                                    accepted
                                @endunless
                            </a>
                            <a href="{{ action('PostController@show', $post) }}" class="button"> {{ $post->getVotesTotal() }} Points </a>
                        </div>
                    </div>
                </article>

                <div class="level post-tags">
                    <div class="level-left">
                        @foreach($post->tags as $tag)
                            @if($tag->thumbnail)
                                <div class="level-item">
                                    <figure class="image is-32x32">
                                        <img title="{{ $tag->name }}" src="{{ asset('img/icons/languages/') }}/{{ $tag->thumbnail }}" alt="{{ $tag->name }}">
                                    </figure>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div class="level-right">
                        <p class="level-item">
                           created {{ $post->getTimePosted() }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach

        {{ $posts->links() }}
    </div>
</div>
