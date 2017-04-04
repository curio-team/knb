<h2 class="is-2">Your answer</h2>
<form method="POST" action="{{action('PostController@store')}}">

    <input type="hidden" name="question_id" value="{{$post->id}}">
    <input type="hidden" name="title" value="reply:{{$post->title}}">
    {{csrf_field()}}

    <div class="field">
        <p class="control">
            <textarea class="textarea tinymce" name="content"></textarea>
        </p>
    </div>
    <button class="button is-primary" type="submit">Submit</button>
</form>