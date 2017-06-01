@extends('layouts.app')

@section('content')
    <div class="container main-content">
        <div class="columns">
            <div class="column is-three-quarters">
                House selection goes here
            </div>

            @include('partials._sidebar')
        </div>
    </div>

    <script src="{{ asset('js/house-selection.js') }}"></script>
@endsection
