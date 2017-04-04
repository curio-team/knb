@extends('layouts/app')

@section('content')
    <div class="container main-content">
        <div class="columns content">
            <div class="column is-three-quarters">
                @include('partials/minis/_single-post')

                @include('partials/minis/_answer-form')

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