@component('mail::message')
# You have an answer on your post!

Link to your post: <br>
<a href="https://hub.amo.rocks/post/{{$post->id}}">{{$post->title}}</a>


Happy Battles!<br>
{{ config('app.name') }}
@endcomponent
