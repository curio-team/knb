@extends('layouts/app')

@section('content')
    <div class="container main-content">
        <div class="columns content">
            <div class="column is-three-quarters">
                @include('partials/minis/_single-post')

                <h2 class="is-2">Your answer</h2>
                <form method="POST" action="{{action('PostController@store')}}">

                    <input type="hidden" name="question_id" value="{{$post->id}}">
                    <input type="hidden" name="title" value="reply:{{$post->title}}">
                    {{ csrf_field() }}

                    <div class="field">
                        <p class="control">
                            <textarea class="textarea tinymce" name="content"></textarea>
                        </p>
                    </div>
                    <button class="button is-primary" type="submit">Submit</button>
                </form>

            </div>

            <div class="column is-one-quarter">
                <div class="content top-ranking">
                    <h3> House rankings </h3>
                    @include('partials/_house-rankings')
                </div>
            </div>

        </div>
    </div>

@endsection