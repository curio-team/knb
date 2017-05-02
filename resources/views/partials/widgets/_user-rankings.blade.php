<div class="content">
    <h3> <i class="fa fa-user"></i> User rankings </h3>
    <div class="content">
        <table class="table">
            <thead>
            <tr>
                <th>Pos</th>
                <th>User</th>
                <th>Points</th>
            </tr>
            </thead>

            <tbody>
                @foreach($rankedUsers as $user)
                    <tr>
                        <td>{{ 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->pointsSum() }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
