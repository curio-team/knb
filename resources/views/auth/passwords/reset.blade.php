@extends('layouts.app')

@section('content')

<div class="columns">
    <div class="column is-one-third is-offset-one-third panel">
        <p class="panel-heading">
            Reset Password
        </p>
        <div class="panel-block">
            @if(session('status'))
                <div class="notification is-info">
                    {{ session('status') }}
                </div>
            @endif

            <form role="form" method="POST" action="{{ route('password.request') }}">
                {{ csrf_field() }}

                <input type="hidden" name="token" value="{{ $token }}">

                <div class="field">
                    <label for="email" class="label">E-Mail Address</label>

                    <p class="control">
                        <input id="email" type="email" class="input{{ $errors->has('email') ? ' is-danger' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                    </p>

                    @if($errors->has('email'))
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                    @endif
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

                <div class="field">
                    <p class="control">
                        <button class="button is-primary" type="submit">Submit</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
