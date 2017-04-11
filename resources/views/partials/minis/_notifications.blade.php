@if(count($errors))
    @foreach($errors->all() as $error)
        <div class="notification is-danger">
            <button class="delete"></button>
            {{$error}}
        </div>
    @endforeach
@endif

@if(Session::has('success'))
    <div class="notification is-primary">
        <button class="delete"></button>
        {{Session::get('success')}}
    </div>
@endif

@if(Session::has('error'))
    <div class="notification is-danger">
        <button class="delete"></button>
        {{Session::get('error')}}
    </div>
@endif