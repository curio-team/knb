@extends('layouts.app')


@section('content')

    <div class="content container main-content">
        <div class="columns">
            <div class="column is-two-thirds" id="#info-game">
                <h1>{{$user->name}}</h1>
                <div class="badge-overview">
                    <h2>Badges:</h2>
                    <div class="columns" style="flex-wrap: wrap">
                    @foreach($user->badges as $badge)
                        <div class="card column is-3" style="margin: 20px">
                            <div class="card-image">
                                <figure class="image">
                                    <img src="{{ $badge->image() }}" alt="{{$badge->title}}">
                                </figure>
                            </div>
                            <div class="card-content" style="padding: 5px">


                                <div class="content" style="text-align:center">
                                    {{ $badge->description }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </div>
                </div>

            </div>
            @include('partials._profile_sidebar')
        </div>
    </div>

@endsection