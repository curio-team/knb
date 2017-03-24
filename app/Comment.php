<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * Get the post associated with the model.
     */
    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }
}
