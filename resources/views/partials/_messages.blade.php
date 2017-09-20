<div class="content">
    <h1> Inbox </h1>
    @if (count($messages ) > 0 )

        <form method="POST" action="{{action('MessageController@checkAllRead')}}">
            {{csrf_field()}}
            <button type="submit" style="margin-bottom: 15px" class="button is-warning">Mark all read</button>
        </form>
    @endif
    <div class="posts" >

        @forelse($messages as $message)

            <div class="{{ $message->read ? 'message-read' : 'message-unread' }} box box-post box-with-options" data-href="{{ action('MessageController@show', $message) }}">
                <div class="box-options">
                    <form action="{{ route('message.destroy', $message) }}" method="POST">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="DELETE">

                        <button type="submit">
                            <i title="delete this message" class="fa fa-2x fa-trash"></i>
                        </button>
                    </form>
                </div>

                <article class="media" >
                    <div class="media-content">
                        <div class="content">
                            <p>
                                <strong><a href="{{ action('MessageController@show', $message) }}"> @if(!$message->read) [NEW!] @endif {{ $message->subject }}</a></strong>
                                @if($message->attachments()->count() > 0)
                                    <small>(Contains attachments)</small>
                                @endif
                            </p>
                        </div>
                    </div>
                </article>

                <div class="level">
                    <div class="level-right">
                        <p class="level-item">
                           sent to you {{ $message->getTimeReceived() }} by {{ is_null($message->sender) ? 'System' : $message->sender->name }}
                        </p>
                    </div>
                </div>
            </div>
        @empty
            <div class="box">
                There are no messages in your inbox
            </div>
        @endforelse
    </div>
</div>
