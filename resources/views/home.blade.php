@extends('layouts.app')

@section('content')
    <div class="container main-content">
        <div class="content columns">
            <div class="column is-three-quarters">
                <h1>newsfeed</h1>
                <nav class="news-panel">
                    @foreach($news as $item)
                        <div class="news-item">
                            <a href="{{action('NewsController@show', $item->id)}}">{{$item->title}}</a>
                            <span>gepost op: <date>{{$item->created_at}}</date></span>
                        </div>
                    @endforeach



                </nav>
            </div>

            @include('partials._sidebar')
        </div>
    </div>
@endsection
