<div class="content">
    <h3> <i class="fa fa-home"></i> House rankings </h3>
        <div class="content">
            <table class="table">
                <thead>
                <tr>
                    <th>Pos</th>
                    <th>House</th>
                    <th>Points</th>
                </tr>
                </thead>

                <tbody>
                    @foreach($houses as $house)
                        <tr>
                            <td>{{ $house->id }}</td>
                            <td>{{ $house->name }}</td>
                            <td>{{ $house->points }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
