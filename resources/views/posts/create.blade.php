@extends('layouts.app')

@section('content')
    <div class="container main-content">
        <div class="content">
            <div class="columns">
                <div class="box column is-two-thirds">
                    <form method="post" action="{{ action('PostController@store') }}">
                        {{ csrf_field() }}

                        <div class="field">
                            <label class="label">Question</label>
                            <p class="control">
                                <input type="text" placeholder="Please be specific about your question" class="input" name="title">
                            </p>
                        </div>

                        <div class="field">
                            <label class="label" for="content">Message</label>
                            <p>Tell us more about your problem:</p>
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
                <div class="column is-one-third panel">
                    <span class="panel-heading">
                        How to ask questions!
                    </span>

                    <div class="panel-block question-info">
                        <ul>
                            <li>
                                First <strong> be sure your question hasn't already been posted. </strong> Use the search function to verify this.
                            </li>

                            <li>
                                <strong> Be specific to your question. </strong> Give as much information as you can. Use links to sandbox
                                environments (<a href="https://codepen.io"> codepen.io </a> for HTML/CSS/Javascript or <a href="https://dotnetfiddle.net"> dotnetfiddle </a> for C#) to illustrate the problem you are dealing with.
                            </li>
                            <li>
                                If you want to use <strong>screen captures</strong> we recommend hosting these on <a href="https://imgur.com"> imgur </a> and post the link in your post.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
