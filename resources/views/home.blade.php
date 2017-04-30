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
                                    <form action="{{action('PostController@search')}}">

                                        <p class="control" style="display: flex">
                                            <input name="query" class="input is-pulled-left" type="text" placeholder="Search">
                                            <button type="submit" class="button is-info is-pulled-left">
                                                <i class="fa fa-search"></i>
                                            </button>
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="level-right">
                            <div class="panel-block level-item">
                                <div class="field is-horizontal">
                                    <div class="field-body">
                                        <div class="field">
                                            <form id="search-tags" action="{{action('PostController@filter')}}">
                                            <p class="control">
                                                @foreach($tags as $tag)
                                                    <label for=""  class="checkbox">
                                                        <input name="tags[]" type="checkbox" value="{{$tag->id}}"
                                                            <?php
                                                                if (isset($searchTags))
                                                                    {
                                                                        if (in_array($tag->id, $searchTags))
                                                                        {
                                                                            echo 'checked';
                                                                        }
                                                                    }

                                                            ?>
                                                        >{{$tag->name}}
                                                    </label>
                                                @endforeach
                                            </p>
                                            </form>
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

            @include('partials._sidebar')

        </div>

    </div>
@endsection
