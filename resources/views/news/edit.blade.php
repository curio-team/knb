@extends('layouts.app')

@section('content')
    <div class="container main-content">
        <div class="content">
            <form method="post" action="{{ action('NewsController@update', $news) }}">
                {{ csrf_field() }}
                
                <input type="hidden" name="_method" value="put">
                <div class="field">
                    <label class="label">Title</label>
                    <p class="control">
                        <input type="text" placeholder="Please be specific about your question" class="input" name="title" value="{{ $news->title }}">
                    </p>
                </div>

                <div class="field">
                    <label class="label">Content</label>
                    <textarea name="content" id="" cols="30" rows="10" class="textarea tinymce">{{ $news->content }}</textarea>
                </div>


                <div class="field is-grouped">
                    <p class="control">
                        <button class="button is-primary">Submit</button>
                    </p>

                    <p class="control">
                        <a class="button is-link" href="{{URL::previous()}}">cancel</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
