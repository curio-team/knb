@extends('layouts.dashboard')

@section('content')
    <div class="columns">
        <div class="column is-half">
            <h2 class="is-2">Import</h2>
            <h3 class="is-3">Import from csv</h3>

            <form class="upload-csv" method="post" action="{{action('ImportController@bulkPointsUpload')}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="field">
                    <label for="upload" class="label">Upload results from csv</label>
                    <input type="file" name="csv" id="csv">
                    <br>
                    <small>Available columns:
                        <ul>
                            <li>"code" (studentcode)</li>
                            <li>"pgo" (v, g or grade)</li>
                            <li> "vht1" (v, g or grade)</li>
                            <li> "vht2" (v, g or grade) </li>
                            <li> "keuze" (v, g or grade)</li>
                            <li> "project" (v, g or grade) </li>
                            <li> "bt1" (grade)</li>
                            <li> "bt2" (grade)</li>
                            <li> "aanwezig" (integer 1 to 100)</li>
                        </ul>
                    </small>
                </div>
                <div class="field">
                    <label><b> check this box and then upload same csv file if you want to redo bulk points </b></label>
                    <input type="checkbox" name="revert" id="revert">
                </div>
                <input type="submit" value="Import" class="button is-primary">
            </form>

            <form class="upload-csv" method="post" action="{{action('ImportController@bulkBadgesUpload')}}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{csrf_token()}}">

                <div class="field">
                    <label for="upload" class="label">Assign badges from csv</label>
                    <input type="file" name="csv" id="csv">
                    <br>
                    <small>Available columns:
                        <ul>
                            <li>"code" (studentcode)</li>
                            <li> "bt1" (grade)</li>
                            <li> "bt2" (grade)</li>
                            <li> "bt3" (grade)</li>
                            <li> "bt4" (grade)</li>
                            <li> "laat" (integer (aantal laatmeldingen)) </li>
                            <li> "aanwezig" (integer 1 to 100)</li>
                        </ul>
                    </small>
                </div>
                <input type="submit" value="Assign Badges" class="button is-primary">
            </form>

        </div>

        <div class="column is-half">
            <h3 class="is-3">Export</h3>
        </div>

    </div>



@endsection