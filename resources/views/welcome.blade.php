@extends('layouts.app')

@section('content')
    <div class="container main-content">
        <div class="columns">
            <div class="column is-three-quarters">
                <posts></posts>
            </div>

            <div class="column is-one-quarter">
                <div class="content top-ranking">
                    <h3> House rankings </h3>
                      <table class="table">
                        <thead>
                            <tr>
                                <th> Pos </th>
                                <th> House </th>
                                <th> Points </th>
                            </tr>
                        </thead>

                        <tbody>
                            <tr>
                                <td> 1 </td>
                                <td> Variable Vikings </td>
                                <td> 167 </td>
                            </tr>
                            <tr>
                                <td> 2 </td>
                                <td> Script Serpents </td>
                                <td> 165 </td>
                            </tr>
                            <tr>
                                <td> 3 </td>
                                <td> Database Dragons </td>
                                <td> 145 </td>
                            </tr>
                            <tr>
                                <td> 4 </td>
                                <td> FooBarbarians </td>
                                <td> 89 </td>
                            </tr>
                        </tbody>
                    </table>
                        <a> more statistics </a>

                </div>

            </div>

        </div>

    </div>
@endsection
