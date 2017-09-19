@extends('layouts.app')


@section('content')

    <div class="content container main-content">
        <h1>Badge request</h1>
        <p> Think you have done something good for the fight? Request a badge here! </p>
        <form action="">
            <div class="field">
                <label for="" class="label">Badge</label>
                <div class="control">
                    <div class="select">
                        <select>
                        @foreach($badges as $badge)
                            <option title="{{$badge->description}}" value="">{{$badge->title}}</option>
                        @endforeach
                        </select>
                    </div>
                </div>

            </div>
        </form>
    </div>

@endsection