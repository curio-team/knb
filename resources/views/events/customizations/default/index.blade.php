@extends('layouts.app')

@section('content')
    <div class="container main-content">
        <div class="content columns">
            <div class="column is-three-quarters">
                <div class="event-show">
                    <h1>{{ $event->title }}</h1>
                    @forelse($event->goals as $goal)
                        @include('events.customizations.' . $goal->view_partial)
                    @empty
                        No goals found for this event.
                    @endforelse
                </div>
            </div>

            @include('partials._sidebar')
        </div>
    </div>
@endsection
