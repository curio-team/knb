<div class="content">
    <h1> Messages </h1>

    <div class="posts" >
        @foreach($messages as $message)
            <div class="box box-post" data-href="{{ action('MessageController@show', $message) }}">
                <article class="media" >
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong>{{ $message->sender->name }}</strong>
                                <br>
                                <a href="{{ action('MessageController@show', $message) }}">{{ $message->subject }}</a>
                            </p>

                        </div>
                    </div>
                </article>

                <div class="level">
                    <div class="level-right">
                        <p class="level-item">
                           created {{ $message->getTimeReceived() }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
