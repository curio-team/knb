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
                                <a class="option"  href="{{action('PostController@edit', $post->id) }}" class="option-flag">
                                    <i class="fa fa-2x fa-flag"></i>
                                </a>
                                <form class="flag-form" style="display:none" action="{{ action('PostController@flag', $post) }}" method="POST">
                                    {{ csrf_field() }}
                                </form>
                            @else
                                <span class="option" title="this post is flagged. A moderator will look into this soon.">
                                    <i class="fa fa-2x fa-flag is-danger"></i>
                                </span>
                            @endunless
                        @endif
                    </div>

                    <div class="columns">
                        <div class="column">
                            @include('partials.minis._vote-group')
                        </div>
                        <div class="column is-11">
                            <h4 class="title is-4">{{ $post->title }}</h4>
                            <span class="author">author: {{ $post->author->name }}</span>

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
                        <a href="{{ action('PostController@answer', $post) }}" class="button is-success">Give answer</a>

                        <a href="" class="btn-add-comment button is-info">Add comment</a>
                    </div>

                    <div class="form-comment-hidden">
                        @include('partials._create-comment')
                    </div>

                    <h3 class="is-3">{{ $post->comments->count() }} {{ str_plural('comment', $post->comments->count()) }}</h3>
                    <div class="comment-box">
                        @foreach($post->comments as $comment)
                            <article class="media">
                                <div class="content media-post-comment">
                                    <strong>{{ $comment->author->name }}</strong>

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
                                        <a class="option"  href="{{action('PostController@edit', $post->id) }}" class="option-flag">
                                            <i class="fa fa-2x fa-flag"></i>
                                        </a>
                                        <form class="flag-form" style="display:none" action="{{ action('PostController@flag', $post) }}" method="POST">
                                            {{ csrf_field() }}
                                        </form>
                                        @else
                                            <span class="option" title="this post is flagged. A moderator will look into this soon.">
                                    <i class="fa fa-2x fa-flag is-danger"></i>
                                </span>
                                            @endunless
                                        @endif
                            </div>

                            <div class="columns">
                                <div class="column">
                                    @include('partials.minis._vote-group')
                                </div>
                                <div class="column is-11">
                                    <span class="author">author: {{ $post->author->name }}</span>

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

                            <div class="button-group">
                                <a href="" class="btn-add-comment button is-info">Add comment</a>
                            </div>

                            <div class="form-comment-hidden">
                                @include('partials._create-comment')
                            </div>

                            <div class="comment-box">
                                @foreach($post->comments as $comment)
                                    <article class="media">
                                        <div class="content media-post-comment">
                                            <strong>{{ $comment->author->name }}</strong>

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
