@extends('layouts.app')

@section('content')

    <div class="container main-content">

        <div class="content">
            <form method="post" action="{{ action('PostController@update', $post->id) }}">
                {{ csrf_field() }}
                <input type="hidden" name="_method" value="put">
                <div class="field">
                    <label class="label">Title</label>
                    <p class="control">
                        <input type="text" placeholder="Please be specific about your question" class="input" name="title" value="{{$post->title}}">
                    </p>
                </div>
                <div class="field">
                    <label class="label">Question</label>
                    <textarea name="content" id="" cols="30" rows="10" class="textarea tinymce">{{$post->content}}</textarea>
                </div>
                <div class="field">
                    <label class="label">Add tags</label>
                    <div class="field-body">
                        <div class="field is-narrow">
                            <div class="control">
                                @foreach($tags as $tag)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="tag[]">
                                        {{$tag->name}}
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="field is-grouped">
                    <p class="control">
                        <button class="button is-primary">Submit</button>
                    </p>
                    <p class="control">
                        <button class="button is-link">cancel</button>
                    </p>
                </div>
            </form>
        </div>
    </div>

@endsection