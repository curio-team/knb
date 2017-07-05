@extends('layouts.app')


@section('content')

        <div class="content container main-content">
            <div class="columns">
                <form method="POST" class="is-6" action="{{action('UsersController@changePassword')}}">
                    {{method_field('PUT')}}
                    {{ csrf_field() }}
                    <div class="field">
                        <label for="" class="label">New Password</label>
                        <p class="control">
                            <input name="password" type="password" class="input" placeholder="enter new password">
                        </p>
                    </div>
                    <div class="field">
                        <label for="" class="label">Confirm Password</label>
                        <p class="control">
                            <input name="password_confirmation" type="password" class="input" placeholder="confirm your password">
                        </p>
                    </div>
                    <div class="field">
                        <button type="submit" class="button is-primary">Change</button>
                    </div>
                </form>
            </div>
        </div>


@endsection