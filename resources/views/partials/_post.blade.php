
<div class="content">
        <article class="media ">
            <figure class="media-type media-left media-question">
                <img src="{{asset('img/icons/question.png')}}" alt="">
            </figure>
            <div class="media-content">
                <div class="content  media-post">
                    <p>
                        <strong>{{$post->author->name}}</strong>
                    </p>
                    <h4 class="title is-4">{{$post->title}}</h4>
                    <p>{!! $post->content !!}
                    </p>
                    <div class="button-group">
                        <a href="{{action('PostController@answer', $post->id)}}" class="button is-info">Give answer</a>
                        <a href="" class="btn-add-comment button is-primary">Add comment</a>
                        @include('partials.minis._vote-group')
                    </div>
                    <div class="form-comment-hidden">
                        @include('partials/_create-comment')
                    </div>
                    <h3 class="is-3">{{count($post->comments)}} comments</h3>

                    @foreach($post->comments as $comment)
                    <article class="media">
                        <div class="content media-post-comment">
                            <strong>{{$comment->author->name}}</strong>

                            <p>{{$comment->content}}</p>
                        </div>
                    </article>
                    @endforeach
                </div>
                <h2 class="is-2">{{count($replies)}} Answers</h2>
                @foreach($replies as $reply)
                <article class="media">
                    @if ($loop->first)
                    <figure class="media-type media-accepted media-left">
                        <img src="{{asset('img/icons/accepted.png')}}" alt="">
                    </figure>
                    @else
                    <figure class="media-type media-answer media-left">
                        <img src="{{asset('img/icons/answer.png')}}" alt="">
                    </figure>
                    @endif
                    <div class="media-content">
                        <div class="content media-post">
                            <p>
                                <strong>{{$reply->author->name}}</strong>
                            </p>
                            <p>
                               {!! $reply->content !!}
                            </p>
                            <div class="button-group">
                                <a href="" class="btn-add-comment button is-primary">Add comment</a>
                                @include('partials.minis._vote-group')
                            </div>
                            <div class="form-comment-hidden">
                                @include('partials/_create-comment')
                            </div>
                            <h3 class="is-3">{{count($reply->comments)}} comments</h3>

                            @foreach($reply->comments as $comment)
                                <article class="media">
                                    <div class="content media-post-comment">
                                        <strong>{{$comment->author->name}}</strong>

                                        <p>{{$comment->content}}</p>
                                    </div>
                                </article>
                            @endforeach



                        </div>


                    </div>
                </article>
                @endforeach

            </div>
        </article>
    </div>
