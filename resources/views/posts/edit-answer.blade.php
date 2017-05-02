@extends('layouts.app')

@section('content')
    <div class="container main-content">
        <div class="columns content">
            <div class="column is-three-quarters">
                <div class="content">
                    <article class="media ">
                        <figure class="media-type media-left media-question">
                            <img src="{{ asset('img/icons/question.png') }}" alt="">
                        </figure>
                        <div class="media-content">
                            <div class="content media-post">
                                <p>
                                    <strong>{{ $post->parent->author->name }}</strong>
                                </p>

                                <h4 class="title is-4">{{ $post->parent->title }}</h4>

                                <p>{!! $post->parent->content !!}</p>
                            </div>
                        </div>
                    </article>
                </div>

                <h2 class="is-2">Your answer</h2>
                <form method="POST" action="{{ action('PostController@updateAnswer', $post) }}">
                    <input type="hidden" name="_method" value="put">
                    <input type="hidden" name="question_id" value="{{ $post->id }}">
                    <input type="hidden" name="title" value="reply:{{ $post->title }}">

                    {{ csrf_field() }}

                    <div class="field">
                        <p class="control">
                            <textarea class="textarea tinymce" name="content">{{$post->content}}</textarea>
                        </p>
                    </div>

                    <button class="button is-primary" type="submit">Submit</button>
                </form>
            </div>

            <div class="column is-one-quarter">
                <div class="content top-ranking">
                    <h3> House rankings </h3>
                    @include('partials._house-rankings')
                </div>
            </div>
        </div>
    </div>
@endsection
