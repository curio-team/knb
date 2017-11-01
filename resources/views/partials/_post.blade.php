@php ($question = $post)

<div class="content">
    <article class="media ">
        <figure class="media-type media-left media-question">
            <img src="{{ asset('img/icons/question.png') }}" alt="">
        </figure>

        <div class="media-content">
            <div class="content media-post">
                <div class="box box-with-options">
                    <div class="box-options">
                        @if(\Auth::user()->isHeadMaster())
                            @include("partials/minis/_post-admin-controls")
                        @endif
                        @if($question->isYours())
                            <a class="option"  href="{{ action('PostController@edit', $post) }}" class="option-edit">
                                <i class="fa fa-2x fa-edit"></i>
                            </a>
                        @else
                            @unless($post->isFlagged())
                                <i class="option-flag">
                                    <i title="flag this post" class="fa fa-2x fa-flag"></i>
                                </i>

                                <form class="flag-form" style="display:none" action="{{ action('PostController@flag', $post) }}" method="POST">
                                    {{ csrf_field() }}
                                </form>
                            @else
                                <i title="this post is flagged. A moderator will look into this soon." style="color: red">
                                    flagged
                                </i>
                            @endunless
                        @endif
                    </div>

                    <div class="columns">
                        <div class="column">
                            @include('partials.minis._vote-group')
                            <img style="margin-top: 25px" src="{{$post->author->houserole->house->thumbnail()}}" alt="">
                        </div>
                        <div class="column is-11">
                            <h4 class="title is-4">{{ $post->title }}</h4>
                            @if($post->author->isHeadmaster())
                                <span style="text-shadow: 0px 0px 1px black; color: gold" class="author"> {{ $post->author->name }}</span>
                            @else
                                <span class="author">author: {{ $post->author->name }}</span>
                            @endif
                            <p>{!! $post->content !!}</p>
                        </div>
                    </div>

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
                               <i> created {{ $post->getTimePosted() }} </i>
                            </p>
                        </div>
                    </div>
                    <div class="button-group">
                        @unless ($post->isLocked())
                        <a href="{{ action('PostController@answer', $post) }}" class="button is-success">Give answer</a>
                        <a href="" class="btn-add-comment button is-info" >Add comment</a>
                        @else
                        <p style="color: red; border: 1px solid red">OOPS! This post is locked. You can not comment or answer this post</p>
                        @endunless
                    </div>

                    <div class="form-comment-hidden">
                        @include('partials._create-comment')
                    </div>

                    <h3 class="is-3">{{ $post->comments->count() }} {{ str_plural('comment', $post->comments->count()) }}</h3>
                    <div class="comment-box">
                        @foreach($post->comments as $comment)
                            <article class="media">
                                <figure class="image is-32x32">
                                    <img src="{{$comment->author->houserole->house->thumbnail()}}" alt="">
                                </figure>
                                <div class="content media-post-comment">
                                    @if($comment->author->isHeadmaster())
                                        <span style="text-shadow: 0px 0px 1px black; color: gold" class="author"> {{ $comment->author->name }}</span>
                                    @else
                                        <strong>{{ $comment->author->name }}</strong>
                                    @endif
                                    <p>{!! nl2br($comment->content) !!}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </div>

            <h2 class="is-2">{{ count($replies) }} Answers</h2>

            @foreach($replies as $post)
                <article class="media">

                    @if ($post->accepted_answer)
                        <figure class="media-type media-accepted media-left">
                            <img src="{{ asset('img/icons/accepted.png') }}" alt="">
                        </figure>
                    @else
                        <figure class="media-type media-answer media-left">
                            <img src="{{ asset('img/icons/answer.png') }}" alt="">
                        </figure>
                    @endif

                    <div class="media-content">

                        <div class="content media-post box box-with-options">
                            <div class="box-options">
                                @if(\Auth::user()->isHeadMaster())
                                    @include("partials/minis/_post-admin-controls")
                                @endif
                                @if($question->isYours())
                                    <a class="option"  href="{{ action('PostController@edit', $post) }}" class="option-edit">
                                        <i class="fa fa-2x fa-edit"></i>
                                    </a>
                                @else
                                    @unless($post->isFlagged())
                                        <i class="option-flag">
                                            <i title="flag this post" class="fa fa-2x fa-flag"></i>
                                        </i>
                                       <form class="flag-form" style="display:none" action="{{ action('PostController@flag', $post) }}" method="POST">
                                            {{ csrf_field() }}
                                        </form>
                                    @else
                                        <i title="this post is flagged. A moderator will look into this soon." style="color: red">
                                            flagged
                                        </i>
                                    @endunless
                                @endif
                            </div>

                            <div class="columns">
                                <div class="column">
                                    @include('partials.minis._vote-group')
                                    <figure class="image is-64x64">
                                        <img src="{{$post->author->houserole->house->thumbnail()}}" alt="">
                                    </figure>
                                </div>
                                <div class="column is-11">
                                    @if($post->author->isHeadmaster())
                                        author: <span style="text-shadow: 0px 0px 1px black; color: gold" class="author"> {{ $post->author->name }}</span>
                                    @else
                                        <span class="author">author: {{ $post->author->name }}</span>
                                    @endif
                                    <p>{!! $post->content !!}</p>
                                </div>
                            </div>

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
                                        <i> created {{ $post->getTimePosted() }} </i>
                                    </p>
                                </div>
                            </div>

                            @if($question->isYours())
                                <form method="POST" action="{{ action('PostController@accept', $post) }}">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="_method" value="put">

                                    @if ($post->accepted_answer)
                                        <button type="submit" class="button is-warning" value="0" name="accepted">Cancel acceptation</button>
                                    @elseif(! $question->isAccepted())
                                        <button type="submit" class="button is-success" value="1" name="accepted">Accept this answer</button>
                                    @endif
                                </form>
                            @endif

                            @unless( $post->parent->isLocked() )
                            <div class="button-group">
                                <a href="" class="btn-add-comment button is-info">Add comment</a>
                            </div>
                            @endunless
                            <div class="form-comment-hidden">
                                @include('partials._create-comment')
                            </div>

                            <div class="comment-box">
                                @foreach($post->comments as $comment)
                                    <article class="media">
                                        <div class="content media-post-comment">

                                            @if ($comment->author->isHeadmaster())
                                                <span style="text-shadow: 0px 0px 1px black; color: gold" class="author"> {{ $comment->author->name }}</span>
                                            @else
                                                <strong>{{ $comment->author->name }}</strong>;
                                            @endif

                                            <p>{!! nl2br($comment->content) !!}</p>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </article>
</div>
