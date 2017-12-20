<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{


    /**
     * posts
     *
     * @return \Illuminate\Http\Response
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tags');
    }
}
