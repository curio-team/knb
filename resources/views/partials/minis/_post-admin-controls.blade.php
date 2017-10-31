<div class="option" style="position: relative">
    <i class="enable-admin-controls is-warning fa fa-user-md fa-2x"></i>

    <ul class="admin-controls">

        <li data-id="{{$post->id}}" class="admin-control btn-admin-control-lock">
            <i class="fa fa-lock"></i> lock this post
        </li>

        <li data-id="{{ $post->id }}" class="admin-control btn-admin-control-remove">
            <i class="fa fa-remove"></i> remove this post
        </li>
    </ul>
</div>