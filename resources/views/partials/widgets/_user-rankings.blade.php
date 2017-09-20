<div class="content">
    <h3> <i class="fa fa-user"></i> User rankings </h3>
    <div class="content">
        <table class="table">
            <thead>
            <tr>
                <th></th>
                <th>Pos</th>
                <th>User</th>
                <th>Points</th>
            </tr>
            </thead>

            <tbody>
                <?php $index = 0; ?>
                @foreach($rankedUsers as $user)
                    <tr>
                        <td>
                            <img class="image is-16x16" src="{{$user->houseRole->house->thumbnail()}}" alt="">
                        </td>
                        <td>{{ $index += 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->points }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
