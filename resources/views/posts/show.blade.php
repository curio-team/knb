@extends('layouts/app')

@section('content')
<div class="container main-content">
    <post v-bind:post_id={{$id}}></post>
</div>

@endsection