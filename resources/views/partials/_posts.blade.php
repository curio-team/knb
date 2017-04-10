<div class="content">
        <h1> Forum </h1>
        <div class="posts" >
            @foreach($posts as $post)
            <div class="box box-post">
                <div class="box-options">
                    <a href="{{action('PostController@edit', $post->id)}}" class="option-edit">edit</a>
                    <a href="{{action('PostController@edit', $post->id)}}" class="option-flag">flag</a>
                </div>
                <article class="media" >


                        <figure class="media-left">
                            <p class="image is-64x64">
                                <img src="http://bulma.io/images/placeholders/128x128.png">
                            </p>

                        </figure>

                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>{{ $post->author->name }}</strong>
                                <br>
                                <a href="{{action('PostController@show', $post->id)}}">{{ $post->title }}</a>
                            </p>

                        </div>
                        <div class="block">
                        <a href="{{action('PostController@show', $post->id)}}" class="button">{{ $post->views }} {{ str_plural('view', $post->views) }}</a>
                        <a href="{{action('PostController@show', $post->id)}}" class="button @if($post->isAccepted()) is-success @endif">
                        @unless($post->isAccepted())
                        {{ $post->getAnswerTotal() }}  {{ str_plural('answer', $post->getAnswerTotal()) }}
                        @else
                        accepted
                        @endunless
                        </a>
                        <a href="{{action('PostController@show', $post->id)}}" class="button"> {{$post->getVotesTotal() }} Points </a>
                        </div>
                    </div>

                </article>
            </div>
            @endforeach

            {{$posts->links()}}
        </div>
    </div>
