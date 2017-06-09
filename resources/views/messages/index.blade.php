@extends('layouts.app')

@section('content')
    <div class="container main-content">
        <div class="columns">
            <div class="column is-three-quarters">
                @if(\Auth::user()->isHeadMaster())
                    <nav class="level">
                        <div class="level-right">
                            <div class="level-item">
                                <a href="{{ route('message.create') }}" class="button ask-question is-pulled-right is-primary">Create Message</a>
                            </div>
                        </div>
                    </nav>
                @endif

                @include('partials._messages')
            </div>

            @include('partials._sidebar')
        </div>
    </div>
@endsection
