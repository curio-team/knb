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
                    </figure>
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>{{$post->author->name}}</strong>
                                <br>
                                <a href="{{action('PostController@show', $post->id)}}">{{$post->title}}</a>

                            </p>
                            <div class="post-meta">
                          <span class="views-amount">
                            4
                          </span>
                                views
                            </div>
                        </div>
                    </div>

                </article>
            </div>
            @endforeach
        </div>
    </div>
