<div class="vote-group is-pulled-right">
    @unless($post->isYours() || $post->userHasVoted())
        <span class="fa fa-arrow-up fa-2x" onclick="event.preventDefault();
            $(this).closest('.button-group').find('.vote-form .vote-type').val('up');
            $(this).closest('.button-group').find('.vote-form').submit();" >
        </span>
    @endunless

    <span class="tag is-medium is-dark">{{ $post->getVotesTotal() }}</span>

    @unless($post->isYours() || $post->userHasVoted())
        <span class="fa fa-arrow-down fa-2x " onclick="event.preventDefault();
           $(this).closest('.button-group').find('.vote-form .vote-type').val('down');
           $(this).closest('.button-group').find('.vote-form').submit();">
        </span>
    @endunless

    @if($post->userHasVoted())
        voted
    @endif
</div>

<form class="vote-form" data-vote="null" action="{{ action('PostController@vote', $post) }}" method="POST" style="display: none;">
    <input type="hidden" name="vote" class="vote-type" value="">
    {{ csrf_field() }}
</form>
