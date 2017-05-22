<div class="vote-group">
    @unless($post->isYours() || $post->userHasVoted())
        <span class="fa fa-arrow-up fa-2x" onclick="event.preventDefault();
            $(this).closest('.vote-group').find('.vote-form .vote-type').val('up');
            $(this).closest('.vote-group').find('.vote-form').submit();" >
        </span>
    @endunless

    <span class="tag is-medium is-dark">{{ $post->getVotesTotal() }}</span>

    @if($post->userHasVoted())
        voted
    @endif
        <form class="vote-form" data-vote="null" action="{{ action('PostController@vote', $post) }}" method="POST" style="display: none;">
            <input type="hidden" name="vote" class="vote-type" value="">
            {{ csrf_field() }}
        </form>
</div>


