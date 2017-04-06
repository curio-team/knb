@extends('layouts.app')

@section('content')
<div class="columns">
    <div class="column is-one-third is-offset-one-third panel">
        <p class="panel-heading">
            Reset Password
        </p>
        <div class="panel-block">
            @if(session('status'))
                <div class="notification">
                    <button class="delete"></button>
                    {{ session('status') }}
                </div>
            @endif

            <form role="form" method="POST" action="{{ route('password.email') }}">
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
                    <p class="control">
                        <button class="button is-primary" type="submit">Submit</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
