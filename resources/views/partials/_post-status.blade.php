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
                        @if(\Auth::user()->isHeadMaster() || \Auth::user()->isEditor())
                            @include("partials/minis/_post-admin-controls")
                        @endif
                        @unless($post->isLocked())
                            @if($post->isYours() ||(\Auth::user()->isHeadMaster() || \Auth::user()->isEditor()))
                                
                                @if($post->flags == 3)
                                    <i class="fa fa-2x fa-remove" style="color: red" title="this post should be removed"></i>
                                @else

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

                    <div class="columns">
                        <div class="column">
                            @include('partials.minis._vote-group')
                            <img style="margin-top: 25px" src="{{$post->author->houserole->house->thumbnail()}}" alt="">
                        </div>
                        <div class="column is-11">
                            <h4 class="title is-4">{{ $post->title }}</h4>
                            @if($post->author->isHeadmaster())
                                author: <span style="text-shadow: 0px 0px 3px black; color: gold" class="author"> {{ $post->author->name }}</span>
                            @else
                                @if($post->author->isEditor())
                                    author: <span style="text-shadow: 0px 0px 3px black; color: silver" class="author"> {{ $post->author->name }}</span>
                                @else
                                    <span class="author">author: {{ $post->author->name }}</span>
                                @endif
                            @endif
                            
                            <p>{!! $post->content !!}</p>
                            <p>flaggers: {{ count($post->GetFlags ) }}</p>
                            @foreach($post->GetFlags as $flag)
                                @unless(count($flag->parent) > 0)
                                    <div class="box box-with-options">
                                        <div class="box-options" data-id="{{ $flag->id }}">
                                            <!--<i class="option-flag option-status-flag">
                                                <i title="flag this post" class="fa fa-2x fa-flag"></i>
                                            </i>-->
                                        </div>
                                        @if($flag->flagger->isHeadmaster())
                                            <span>flagger: </span><span style="text-shadow: 0px 0px 3px black; color: gold" class="author"> {{ $flag->flagger->name }}</span> <span> {{ $flag->GetAction() }} </span>

                                            <p>
                                                {{ $flag->reason }}
                                            </p>

                                            
                                        @else
                                            @if($flag->flagger->isEditor())
                                                flagger: <span style="text-shadow: 0px 0px 3px black; color: silver" class="author"> {{ $flag->flagger->name }}</span> <span> {{ $flag->GetAction() }} </span>
                                                <p>
                                                    {{ $flag->reason }}
                                                </p>
                                            @else
                                                <span class="author">flagger: {{ $flag->flagger->name }}</span><span> {{ $flag->GetAction() }} </span>
                                                <p>
                                                    {{ $flag->reason }}
                                                </p>
                                            @endif
                                        @endif
                                        <div class=".status-form" data-id="{{ $flag->id }}" data-post="{{ $post->id }}">
                                            <div class="field">
                                                <p class="control">
                                                    <textarea class="textarea" name="content" placeholder="Add a your reason..."></textarea>
                                                </p>
                                            </div>

                                            <div class="field">
                                                <p class="control">
                                                    <button type="button" class="button add-comment btn-status-control-change">Require a change</button>
                                                    <button type="button" class="button add-comment btn-status-control-removal">Require a removale</button>
                                                    <button type="button" class="button add-comment btn-status-control-unflag">UnFlag</button>
                                                </p>

                                            </div>
                                        </div>

                                        <div style="margin-left: 2rem; ">
                                            @foreach($flag->children as $flag)
                                                @if($flag->flagger->isHeadmaster())
                                                    <span>flagger: </span><span style="text-shadow: 0px 0px 3px black; color: gold" class="author"> {{ $flag->flagger->name }}</span> <span> {{ $flag->GetAction() }} </span>

                                                    <p>
                                                        {{ $flag->reason }}
                                                    </p>

                                                    
                                                @else
                                                    @if($flag->flagger->isEditor())
                                                        flagger: <span style="text-shadow: 0px 0px 3px black; color: silver" class="author"> {{ $flag->flagger->name }}</span> <span> {{ $flag->GetAction() }} </span>
                                                        <p>
                                                            {{ $flag->reason }}
                                                        </p>
                                                    @else
                                                        <span class="author">flagger: {{ $flag->flagger->name }}</span><span> {{ $flag->GetAction() }} </span>
                                                        <p>
                                                            {{ $flag->reason }}
                                                        </p>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endunless
                            @endforeach
                            
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
                            @unless ($post->isAnswer())
                                <a href="{{ action('PostController@answer', $post) }}" class="button is-success">Give answer</a>
                            @endunless
                            <a href="" class="btn-add-comment button is-info" >Add comment</a>
                            <a href="" class="option-flag-post button is-info">Add Flag</a>
                        @endunless
                    </div>

                    <div class="form-comment-hidden">
                        @include('partials._create-comment')
                    </div>
                    <div class="form-flag-hidden" style="display: none;">
                        @include('partials._create-flag')
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
                                        author: <span style="text-shadow: 0px 0px 3px black; color: gold" class="author"> {{ $comment->author->name }}</span>
                                    @else
                                        @if($comment->author->isEditor())
                                            author: <span style="text-shadow: 0px 0px 3px black; color: silver" class="author"> {{ $comment->author->name }}</span>
                                        @else
                                            <span class="author">author: {{ $comment->author->name }}</span>
                                        @endif
                                    @endif
                                    <p>{!! nl2br($comment->content) !!}</p>
                                    @foreach($comment->GetFlags as $flag)
                                        @unless(count($flag->parent) > 0)
                                            <div class="box box-with-options">
                                                <div class="box-options" data-id="{{ $flag->id }}">
                                                    <!--<i class="option-flag option-status-flag">
                                                        <i title="flag this post" class="fa fa-2x fa-flag"></i>
                                                    </i>-->
                                                </div>
                                                @if($flag->flagger->isHeadmaster())
                                                    <span>flagger: </span><span style="text-shadow: 0px 0px 3px black; color: gold" class="author"> {{ $flag->flagger->name }}</span> <span> {{ $flag->GetAction() }} </span>

                                                    <p>
                                                        {{ $flag->reason }}
                                                    </p>

                                                    
                                                @else
                                                    @if($flag->flagger->isEditor())
                                                        flagger: <span style="text-shadow: 0px 0px 3px black; color: silver" class="author"> {{ $flag->flagger->name }}</span> <span> {{ $flag->GetAction() }} </span>
                                                        <p>
                                                            {{ $flag->reason }}
                                                        </p>
                                                    @else
                                                        <span class="author">flagger: {{ $flag->flagger->name }}</span><span> {{ $flag->GetAction() }} </span>
                                                        <p>
                                                            {{ $flag->reason }}
                                                        </p>
                                                    @endif
                                                @endif
                                                <div class=".status-form" data-id="{{ $flag->id }}" data-comment="{{ $comment->id }}">
                                                    <div class="field">
                                                        <p class="control">
                                                            <textarea class="textarea" name="content" placeholder="Add a your reason..."></textarea>
                                                        </p>
                                                    </div>

                                                    <div class="field">
                                                        <p class="control">
                                                            <button type="button" class="button btn-status-control-change-comment">Require a change</button>
                                                            <button type="button" class="button btn-status-control-removal-comment">Require a removale</button>
                                                            <button type="button" class="button btn-status-control-unflag-comment">UnFlag</button>
                                                            @if(\Auth::user()->isHeadmaster())
                                                                <button type="button" class="button btn-status-control-remove-comment">Remove</button>
                                                            @endif
                                                        </p>

                                                    </div>
                                                </div>

                                                <div style="margin-left: 2rem; ">
                                                    @foreach($flag->children as $flag)
                                                        @if($flag->flagger->isHeadmaster())
                                                            <span>flagger: </span><span style="text-shadow: 0px 0px 3px black; color: gold" class="author"> {{ $flag->flagger->name }}</span> <span> {{ $flag->GetAction() }} </span>

                                                            <p>
                                                                {{ $flag->reason }}
                                                            </p>

                                                            
                                                        @else
                                                            @if($flag->flagger->isEditor())
                                                                flagger: <span style="text-shadow: 0px 0px 3px black; color: silver" class="author"> {{ $flag->flagger->name }}</span> <span> {{ $flag->GetAction() }} </span>
                                                                <p>
                                                                    {{ $flag->reason }}
                                                                </p>
                                                            @else
                                                                <span class="author">flagger: {{ $flag->flagger->name }}</span><span> {{ $flag->GetAction() }} </span>
                                                                <p>
                                                                    {{ $flag->reason }}
                                                                </p>
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endunless
                                    @endforeach
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
                                @if(\Auth::user()->isHeadMaster() || \Auth::user()->isEditor())
                                    @include("partials/minis/_post-admin-controls")
                                @endif
                                
                                @unless($post->isLocked())
                                    @if($post->isYours() ||(\Auth::user()->isHeadMaster() || \Auth::user()->isEditor()))
                                        
                                        @if($post->flags == 3)
                                            <i class="fa fa-2x fa-remove" style="color: red" title="this post should be removed"></i>
                                        @else

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

                            <div class="columns">
                                <div class="column">
                                    @include('partials.minis._vote-group')
                                    <figure class="image is-64x64">
                                        <img src="{{$post->author->houserole->house->thumbnail()}}" alt="">
                                    </figure>
                                </div>
                                <div class="column is-11">
                                    @if($post->author->isHeadmaster())
                                        author: <span style="text-shadow: 0px 0px 3px black; color: gold" class="author"> {{ $post->author->name }}</span>
                                    @else
                                        @if($post->author->isEditor())
                                            author: <span style="text-shadow: 0px 0px 3px black; color: silver" class="author"> {{ $post->author->name }}</span>
                                        @else
                                            <span class="author">author: {{ $post->author->name }}</span>
                                        @endif
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

                            @unless( $post->parent->isLocked() || $post->isLocked())
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

                                            @if($comment->author->isHeadmaster())
                                                author: <span style="text-shadow: 0px 0px 3px black; color: gold" class="author"> {{ $comment->author->name }}</span>
                                            @else
                                                @if($comment->author->isEditor())
                                                    author: <span style="text-shadow: 0px 0px 3px black; color: silver" class="author"> {{ $comment->author->name }}</span>
                                                @else
                                                    <span class="author">author: {{ $comment->author->name }}</span>
                                                @endif
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
