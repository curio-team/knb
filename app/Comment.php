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
     * 
     * @return \Illuminate\Http\Response
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    /**
     * author
     *
     * @return \Illuminate\Http\Response
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * isYours
     *
     * @return bool
     */
    public function isYours()
    {
        return \Auth::id() == $this->author->id;
    }

    /**
     * getFlaggedPosts
     *
     * @return \Illuminate\Http\Response
     */
    public static function getFlaggedComments()
    {
        return \App\Comment::where('flags', '>', 0)->get();
    }

    /**
     * is Flagged
     *
     * @return boolean
     */
    public function isFlagged()
    {
        return $this->flags > 0 ? true : false;
    }
    /**
     * GetFlags
     *
     * @return \App\Flag
     */
    public function getFlags()
    {
        return $this->hasMany(Flag::class);
    }

    /**
     * GetFlaggers
     *
     * @return \App\User
     */
    public function GetFlaggers()
    {
        return $this->belongsToMany(User::class, 'flags', 'post_id', 'user_id');
    }

}
