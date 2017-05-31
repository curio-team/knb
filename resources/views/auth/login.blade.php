@extends('layouts.app')

@section('content')
<div class="columns">
    <div class="column is-one-third is-offset-one-third panel">
        <p class="panel-heading">
            Login
        </p>
        <div class="panel-block">
            <form role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}

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
                    <p class="control">
                        <label class="checkbox">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                            Remember me
                        </label>
                    </p>
                </div>

                <div class="field is-grouped">
                    <p class="control">
                        <button name="submit" class="button is-primary" type="submit">Submit</button>
                    </p>

                    <p class="control">
                        <a href="{{ route('password.request') }}" class="button is-link">Forgot Your Password?</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
