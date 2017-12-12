@extends('layouts.app')

@section('content')
    <div class="container main-content">
        <div class="content columns">
            <div class="column is-three-quarters">
              <div class="news-show">
                  <h1>{{$newsItem->title}}</h1>
                  @if(\Auth::user()->isHeadMaster() || \Auth::user()->isEditor())
                    <div class="box-options">
                        <a href="{{ action('NewsController@edit', $newsItem->id) }}" class="option-edit">
                            <i title="edit this news post" class="fa fa-2x fa-edit"></i>
                        </a>
                    </div>
                  @endif
                  <p>{!! nl2br($newsItem->content)  !!}</p>
              </div>
            </div>

            @include('partials._sidebar')
        </div>
    </div>
@endsection
