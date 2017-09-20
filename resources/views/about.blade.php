@extends('layouts.app')

@section('content')
    <div class="content container main-content">

        <h1 class="is-1">Story</h1>
        <div class="columns">
            <div class="column is-half">
            <h3 class="is-3">The 4 houses of the coding kingdom of Null</h3>
            <p><b>"Once upon a time in a future not so very far, the digital world of Null was partitioned into four major factions during a brutal war also known as ‘The Coding Conflict’. This war lasted for at least 10 exabyte. Many, many coding warriors fell tragically for what the warriors held most dear to themself; the eternal debates of which programming language was the most powerful. C# with its beautiful teardropping syntax in conjunction with the powerful Xamarin spell, or the ‘easy to learn, hard to master’ language called PHP, with its legendary buff called Laravel.
                </b></p>
                <p><b>
                    The four houses still battle for what they hold dearest. In the end, one will rise and rule the kingdom."
                </b></p>
            </div>
            <div class="column is-half">

            </div>
        </div>


            <div class="story-houses">
                @foreach($houses as $house)
                    <div class="box">
                        <p class="title"><img src="{{$house->thumbnail()}}" alt="" class="image is-128x128 is-pulled-left">{{$house->name}}</p>
                        <p>{{$house->description}}</p>
                    </div>
                @endforeach
            </div>


    </div>
@endsection
