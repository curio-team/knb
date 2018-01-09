<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class Flag extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'flags';

    const ACTION_STRING = ["Unflagged","Flagged", "Edit", "Removed"];

    /**
     * get the flagger
     *
     * @return \App\User
     */
    public function flagger()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the post
     *
     * @return \App\Post
     */
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    /**
     * Get the comment
     *
     * @return \App\Post
     */
    public function comment()
    {
        return $this->belongsTo(Post::class, 'comment_id');
    }

    /**
     * Get action in string
     *
     * @return string
     */
    public function GetAction()
    {
        return Flag::ACTION_STRING[$this->action];
    }

    /**
     * parent
     * Get the parent post associated with the model.
     *
     * @return \Illuminate\Http\Response
     */
    public function parent()
    {
        return $this->belongsTo(Flag::class, 'add_flag_id');
    }

    /**
     * children
     * Get the child posts associated with the model.
     *
     * @return \Illuminate\Http\Response
     */
    public function children()
    {
        return $this->hasMany(Flag::class, 'add_flag_id');
    }

}
