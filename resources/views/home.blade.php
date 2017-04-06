@extends('layouts.app')

@section('content')
    <div class="container main-content">
        <div class="columns">
            <div class="column is-three-quarters">
                <a href="{{route('post.create')}}" class="button ask-question is-pulled-right is-primary">Ask question</a>
                @include('partials/_posts')
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
