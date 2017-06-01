@extends('layouts.app')

@section('content')
<div class="columns">
    <div class="column is-one-third is-offset-one-third panel">
        <p class="panel-heading">
            Register
        </p>
        <div class="panel-block">
            <form role="form" method="POST" action="{{ route('register') }}">
                {{ csrf_field() }}

                <div class="field">
                    <label for="name" class="label">Name</label>

                    <p class="control">
                        <input id="name" type="text" class="input{{ $errors->has('name') ? ' is-danger' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                    </p>

                    @if($errors->has('name'))
                        <p class="help is-danger">{{ $errors->first('name') }}</p>
                    @endif
                </div>

                <div class="field">
                    <label for="email" class="label">E-Mail address</label>

                    <p class="control">
                        <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ old('email') }}" required>
                    </p>

                    @if($errors->has('email'))
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                    @endif
                </div>

                <div class="field">
                    <label for="house" class="label">House</label>
                    <p class="control">
                        <span class="select">
                        <select name="house" class="input{{ $errors->has('house') ? ' is-danger' : '' }}" id="">
                                <!-- testing purpose --><option value="1" style="visibility:hidden"></option>
                                <option value=""></option>
                            @foreach($houses as $house)
                                <option value="{{$house->id}}">{{$house->name}}</option>
                            @endforeach
                        </select>
                            </span>
                    </p>
                </div>

                <div class="field">
                    <label for="role level" class="label">Role level</label>
                    <p class="control">
                        <span class="select">
                        <select name="level" class="input{{ $errors->has('level') ? ' is-danger' : '' }}" id="">
                            <option value=""></option>
                            <option value="0">Minion</option>
                            <option value="100">Headmaster</option>
                        </select>
                            </span>
                    </p>
                </div>

                <div class="field">
                    <label for="password" class="label">Password</label>

                    <p class="control">
                        <input id="password" type="password" class="input{{ $errors->has('password') ? ' is-danger' : '' }}" name="password" required>
                    </p>

                    @if($errors->has('password'))
                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                    @endif
                </div>




                <div class="field">
                    <label for="password-confirm" class="label">Confirm password</label>

                    <p class="control">
                        <input id="password-confirm" type="password" class="input" name="password_confirmation" required>
                    </p>
                </div>

                <div class="field is-grouped">
                    <p class="control">
                        <button class="button is-primary" type="submit">Register</button>
                    </p>

                    <p class="control">
                        <a href="{{ route('login') }}" class="button is-link">Already have an account?</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
