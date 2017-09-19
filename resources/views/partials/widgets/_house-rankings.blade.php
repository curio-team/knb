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

                        <?php $index = 0; ?>
                        @foreach($houses as $house)
                            <tr>

                                <td>{{ ++$index }}</td>
                                <td>{{ $house->name }}</td>
                                <td>{{ $house->users->sum('points') }}</td>
                            </tr>
                        @endforeach

                </tbody>
            </table>
        </div>
    </div>
