@extends('layouts.app')


@section('content')

    <div class="content container main-content">
        <h1>Badge request</h1>
        <p> Think you have done something good for the fight? Request a badge here! </p>
        <form action="{{route('post-request-badge')}}" method="post">
            {{csrf_field()}}
            <input type="hidden" name="user" value="{{\Auth::user()->id}}">
            <div class="field">
                <label for="" class="label">Badge</label>

                <div class="control">
                    <div class="select">
                        <select name="badge">
                        @foreach($badges as $badge)
                            <option title="{{$badge->description}}" value="{{$badge->id}}">{{$badge->title}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <input type="submit" value="Perform request" class="button is-primary">

            </div>
        </form>
    </div>

@endsection