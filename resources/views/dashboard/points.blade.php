@extends('layouts.dashboard')

@section('content')
    <div id="vue-app">
        <points d="{{$students}}"></points>
    </div>
@endsection
