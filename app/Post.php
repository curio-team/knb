<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    public function isYours()
    {
        return \Auth::user()->id == $this->author->id ? true : false;
    }

    /**
     * Get the author associated with the model.
     */
    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    /*
     * return int
     * returns the views, votes or answers.
     */
    public function getStats()
    {
        return \App\Post::where('post_id', $this->id)->count();
    }

    /**
     * Get the parent post associated with the model.
     */
    public function parent()
    {
        return $this->belongsTo('App\Post', 'post_id');
    }

    /**
     * Get the child posts associated with the model.
     */
    public function children()
    {
        return $this->hasMany('App\Post', 'post_id');
    }

    /**
     * Get the comment posts associated with the model.
     */
    public function comments()
    {
        return $this->hasMany('\App\Comment');
    }
}
