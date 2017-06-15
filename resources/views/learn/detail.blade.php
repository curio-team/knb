@extends('layouts/app')

@section('content')
    <div id="vue-app">
        <videos tag="{{ $tag }}"></videos>
    </div>
@endsection
