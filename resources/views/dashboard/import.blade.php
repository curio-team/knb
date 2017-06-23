@extends('layouts.dashboard')

@section('content')
    <div class="columns">
        <div class="column is-half">
            <h2 class="is-2">Import</h2>
            <h3 class="is-3">Import from csv</h3>
            <form class="upload-csv" method="post" action="{{action('ImportController@upload')}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="field">
                    <label for="upload" class="label">Upload csv file</label>
                    <input type="file" name="csv" id="csv">
                </div>
                <input type="submit" value="Import" class="button is-primary">
            </form>

            <h3 class="is-3">Add user</h3>
            <form action="{{action('UserController@singleRegistration')}}" method="post">
                {{csrf_field()}}
                <div class="field">
                    <label class="label">Name</label>
                    <p class="control">
                        <input type="text" name="name"  placeholder="Please enter full name">
                    </p>
                </div>

                <div class="field">
                    <label class="label">Studentnumber</label>
                    <p class="control">
                        <input name="studentnr" type="text" placeholder="please enter number without prefix ('d').">
                    </p>
                </div>

                <div class="field">
                    <label for="email" class="label">Email</label>
                    <p class="control">
                        <input name="" type="email"  id="">
                    </p>
                </div>

            </form>

        </div>

        <div class="column is-half">
            <h3 class="is-3">Export</h3>
        </div>

    </div>



@endsection