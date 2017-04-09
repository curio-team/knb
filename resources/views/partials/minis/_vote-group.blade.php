@unless($post->isYours())
    <div class="vote-group is-pulled-right">
        <span class="fa fa-arrow-up fa-2x" onclick="event.preventDefault();
                           $('#vote-form').find('.vote-type').val('up');
                           $('#vote-form').submit();" ></span>
        <hr style="margin: 5px">
        <span class="fa fa-arrow-down fa-2x " onclick="event.preventDefault();
                           $('#vote-form').find('.vote-type').val('down');
                           $('#vote-form').submit();"></span>
    </div>


    <form id="vote-form" data-vote="null" action="{{ action('PostController@vote', $post->id) }}" method="POST" style="display: none;">
        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="vote" class="vote-type" value="">
        {{ csrf_field() }}
    </form>
@endunless
