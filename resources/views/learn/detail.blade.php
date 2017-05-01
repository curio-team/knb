@extends('layouts/app')

@section('content')
    <div id="learning">
        <videos tag="{{ $tag }}"></videos>
    </div>
@endsection
