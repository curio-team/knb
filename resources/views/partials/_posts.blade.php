<div class="content">
        <h1> Forum </h1>
        <div class="posts" >
            @foreach($posts as $post)
            <div class="box box-post">
                <article class="media" >

                    <figure class="media-left">
                        <p class="image is-64x64">
                            <img src="http://bulma.io/images/placeholders/128x128.png">
                        </p>
                        <div class="block">
                            <a href="{{action('PostController@show', $post->id)}}" class="button">{{ $post->views }} {{str_plural('view', $post->views)}}</a>
                            <a href="{{action('PostController@show', $post->id)}}" class="button @if($post->isAccepted()) is-success @endif">
                                @unless($post->isAccepted())
                                    {{ $post->getStats() }}  {{str_plural('answer', $post->getStats()) }}
                                @else
                                    accepted
                                @endunless
                            </a>
                            <a href="{{action('PostController@show', $post->id)}}" class="button">{{$post->votes}}  {{str_plural('vote', $post->votes)}}</a>
                        </div>
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>{{$post->author->name}}</strong>
                                <br>
                                <a href="{{action('PostController@show', $post->id)}}">{{$post->title}}</a>
                            </p>

                        </div>
                    </div>

                </article>
            </div>
            @endforeach
        </div>
    </div>
