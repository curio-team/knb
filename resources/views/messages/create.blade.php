@extends('layouts.app')

@section('content')
    <div class="container main-content">
        <div class="content">
            <div class="columns">
                <div class="box column is-two-thirds">
                    <form method="post" action="{{ action('MessageController@store') }}">
                        {{ csrf_field() }}

                        <div class="field">
                            <label class="label">Receiver</label>
                            <p class="control">
                                <input type="text" required placeholder="John Doe" class="input" name="receiver_name" value="{{old('receiver_name')}}">
                            </p>
                        </div>

                        <div class="field">
                            <label class="label">Subject</label>
                            <p class="control">
                                <input type="text" maxlength="255" required placeholder="Think of a descriptive subject" class="input" name="subject" value="{{old('subject')}}">
                            </p>
                        </div>

                        <div class="field">
                            <label class="label" for="content">Content</label>
                            <textarea maxlengt="1000000" name="content" id="content" style="min-height:250px" class="textarea tinymce">{{old('content')}}</textarea>
                        </div>

                        <div class="field is-grouped">
                            <p class="control">
                                <button class="button is-primary">Send</button>
                            </p>

                            <p class="control">
                                <a class="button is-link" href="{{ route('message.index') }}">cancel</a>
                            </p>
                        </div>
                    </form>
                </div>
                <div class="column is-one-third panel">
                    <span class="panel-heading">
                        Sending messages
                    </span>

                    <div class="panel-block">
                        <ul>
                            <li>
                                Do <strong> not ever </strong> send an answer to a question in a personal message. Make sure other people can get help from your answer as well by posting it as an answer on the question in the knowledgebase.
                            </li>

                            <li>
                                <strong> Be nice in personal messages. </strong> Abuse of the personal message system will result in a ban or other punishments.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
