<article class="media">
    <figure class="media-left">
        <p class="image is-64x64">
            <img src="{{Auth::user()->houserole->house->thumbnail()}}">
        </p>
        @if(\Auth::user()->isHeadmaster())
            author: <span style="text-shadow: 0px 0px 1px black; color: gold" class="author"> {{ \Auth::user()->name }}</span>
        @else
            <p class="user-name">{{ Auth::user()->name }}</p>
        @endif
    </figure>

    <div class="media-content">
        <form method="post" action="{{ action('CommentController@store') }}" id="comment-form">
            {{ csrf_field() }}

            <input type="hidden" name="post_id" value="{{ $post->id }}">

            <div class="field">
                <p class="control">
                    <textarea class="textarea" name="content" placeholder="Add a comment..."></textarea>
                </p>
            </div>

            <div class="field">
                <p class="control">
                    <button type="submit" class="button add-comment">Post comment</button>
                </p>
            </div>
        </form>
    </div>
</article>
