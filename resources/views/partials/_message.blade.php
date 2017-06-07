<div class="content">
    <article class="media ">
        <div class="media-content">
            <div class="content media-post">
                <div class="box">
                    <h4 class="title is-4">{{ $message->subject }}</h4>
                    <span class="author">sender: {{ $message->sender->name }}</span>

                    <div style="word-break: break-all;">
                    <p>{!! $message->content !!}</p>
                    </div>

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
