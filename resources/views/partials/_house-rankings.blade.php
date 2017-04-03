    <div class="content top-ranking">
        <table class="table">
            <thead>
            <tr>
                <th> Pos </th>
                <th> House </th>
                <th> Points </th>
            </tr>
            </thead>

            <tbody>
            @foreach($houses as $house)
                <tr>
                    <td> {{ $house->id }} </td>
                    <td> {{ $house->name }} </td>
                    <td> 167 </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <a> more statistics </a>

    </div>
