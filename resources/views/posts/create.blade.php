@extends('layouts.app')

@section('content')
    <div class="container main-content">
        <div class="content">
            <div class="columns">
                <div class="column is-offset-two-thirds is-one-third panel is-pulled-right">
                    <p class="panel-heading">
                        How to ask questions!
                    </p>

                    <div class="panel-block">
                        <ul>
                            <li>
                                First <strong> be sure your question hasn't already been posted. </strong> Use the search function to verify this.
                            </li>

                            <li>
                                <strong> Be specific to your question. </strong> Give as much information as you can. Use links to sandbox
                                environments (codepen.io for example) to illustrate the problem you are dealing with.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <form method="post" action="{{ action('PostController@store') }}">
                {{ csrf_field() }}

                <div class="field">
                    <label class="label">Title</label>
                    <p class="control">
                        <input type="text" placeholder="Please be specific about your question" class="input" name="title">
                    </p>
                </div>

                <div class="field">
                    <label class="label" for="content">Question</label>
                    <textarea name="content" id="content" style="min-height:250px" class="textarea tinymce"></textarea>
                </div>

                <div class="field">
                    <label class="label">Add tags</label>
                    <div class="field-body">
                        <div class="field is-narrow">
                            <div class="control">
                                @foreach($tags as $tag)
                                    <label class="checkbox-inline">
                                        <input type="checkbox" name="tag[]" value="{{ $tag->id }}">
                                        {{ $tag->name }}
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
                        <a class="button is-link" href="{{ route('home') }}">cancel</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection
