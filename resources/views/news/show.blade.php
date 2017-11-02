@extends('layouts.app')

@section('content')
    <div class="container main-content">
        <div class="content columns">
            <div class="column is-three-quarters">
              <div class="news-show">
                  <h1>{{$newsItem->title}}</h1>
                  <p>{!! nl2br($newsItem->content)  !!}</p>
              </div>
            </div>

            @include('partials._sidebar')
        </div>
    </div>
@endsection
