@extends('layouts.dashboard')

@section('content')
    <div class="columns is-mobile is-multiline">
        <div class="column is-one-third-desktop is-full-mobile flagged-posts">
            <section class="panel">
                <p class="panel-heading">
                    Flagged posts
                </p>
                @foreach($flagged as $post)
                    <a class="panel-block" href="{{ action('PostController@show', $post) }}">
                        {{  $post->title }}
                        <button  class="button is-pulled-right" disabled>{{$post->flags}}</button>
                    </a>
                @endforeach

            </section>
        </div>
        <div class="column is-one-third-desktop is-full-mobile">
            <section class="panel">
                <p class="panel-heading">
                    Sales
                </p>
                <div class="panel-block">

                </div>
                <div class="panel-block">

                </div>
            </section>
        </div>
        <div class="column is-one-third-desktop is-full-mobile">
            <section class="panel">
                <p class="panel-heading">
                    YoY Comparison
                </p>
                <div class="panel-block">

                </div>
                <div class="panel-block">

                </div>
            </section>
        </div>
        <div class="column is-half-desktop is-full-mobile">
            <section class="panel">
                <p class="panel-heading">
                    Notifications
                </p>
                <div class="panel-block">

                </div>
            </section>
        </div>
        <div class="column is-half-desktop is-full-mobile">
            <section class="panel">
                <p class="panel-heading">
                    Forecast
                </p>
                <div class="panel-block">

                </div>
            </section>
        </div>
        <div class="column is-half-desktop is-full-mobile">
            <section class="panel">
                <p class="panel-heading">
                    Popular Followers
                </p>
                <div class="panel-block">

                </div>
            </section>
        </div>
        <div class="column">
            <section class="panel">
                <p class="panel-heading">
                    Message User
                </p>
                <div class="panel-block">

                </div>
            </section>
        </div>
    </div>

@endsection