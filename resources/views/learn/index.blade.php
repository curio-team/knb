@extends('layouts/app')

@section('content')
    <div id="vue-app">
        <div class="container">
            <div class="content">
            <h1>Learn</h1>
                <videos-overview></videos-overview>
                <tools></tools>
                <resource-links></resource-links>
            </div>
        </div>
    </div>
@endsection
