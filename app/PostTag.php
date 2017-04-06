<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'post_tags';

    /**
     * Get the post associated with the model.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the tag associated with the model.
     */
    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
