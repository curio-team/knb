@extends('layouts.app')

@section('content')
    <div class="container main-content">
        <div class="columns">
            <div class="column is-three-quarters">

                <nav class="level">
                    <div class="level-left">
                        <div class="level-item">
                            <button class="button filter-questions is-primary">Filter &nbsp;<i class="fa fa-2X fa-caret-down"></i></button>
                        </div>
                    </div>
                    <div class="level-right">
                        <div class="level-item">
                            <a href="{{route('post.create')}}" class="button ask-question is-pulled-right is-primary">Ask question</a>
                        </div>
                    </div>
                </nav>
                <nav class="panel filter-panel">
                    <p class="panel-heading">
                        Filter
                    </p>
                    <div class="level">
                        <div class="level-left">
                            <div class="panel-block level-item">
                                <div class="field has-addons">
                                    <p class="control has-icon">
                                        <input class="input" type="text" placeholder="Search">
                                          <span class="icon">
                                            <i class="fa fa-search"></i>
                                          </span>
                                    </p>
                                    <p class="control">
                                        <a href="" class="button is-info">
                                            <i class="fa fa-search"></i>
                                        </a>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="level-right">
                            <div class="panel-block level-item">
                                <div class="field is-horizontal">
                                    <div class="field-body">
                                        <div class="field">
                                            <p class="control">
                                                @foreach($tags as $tag)
                                                    <label for="" class="checkbox">
                                                        <input type="checkbox" value="{{$tag->id}}">{{$tag->name}}
                                                    </label>
                                                @endforeach
                                            </p>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </nav>
                @include('partials/_posts')
            </div>

            <div class="column is-one-quarter">
                <div class="content top-ranking">
                    <h3> House rankings </h3>
                    @include('partials/_house-rankings')
                </div>

            </div>

        </div>

    </div>
@endsection
