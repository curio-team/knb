@extends('layouts.app')

@section('content')
    <div class="container main-content">
        <div class="columns">
            <div class="column is-three-quarters">
                <posts></posts>
            </div>

            <div class="column is-one-quarter">
                <div class="content top-ranking">
                    <h3> House rankings </h3>
                    <house-rankings></house-rankings>
                </div>

            </div>

        </div>

    </div>
@endsection
