<div class="content">
    <article class="media ">
        <figure class="media-type media-left media-question">
            <img src="{{ asset('img/icons/question.png') }}" alt="">
        </figure>
        <div class="media-content">
            <div class="content  media-post">
                <p>
                    <strong>{{ $post->author->name }}</strong>
                </p>
                <h4 class="title is-4">{{ $post->title }}</h4>
                <p>{!! $post->content !!}

                </p>
            </div>
        </div>
    </article>

</div>