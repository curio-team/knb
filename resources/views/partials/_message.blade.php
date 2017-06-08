@php($attachments = $message->attachments())

<div class="content">
    <article class="media ">
        <div class="media-content">
            <div class="content media-post">
                <div class="box">
                    <h4 class="title is-4">{{ $message->subject }}</h4>
                    <span class="author">sender: {{ is_null($message->sender) ? 'System' : $message->sender->name }}</span>

                    <div style="word-break: break-all;">
                    <p>{!! $message->content !!}</p>
                    </div>

                    @if($attachments->count() > 0)
                    <ul class="attachments">
                        @foreach($attachments->get() as $attachment)
                            <li>{{ $attachment->description() }}</li>
                        @endforeach
                    </ul>
                    @endif

                    <div class="level-right">
                        <p class="level-item">
                           <i> received {{ $message->getTimeReceived() }} </i>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </article>
</div>
