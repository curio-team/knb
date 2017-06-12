<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use \Carbon\Carbon;

class Post extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * @var array
     */
    protected $fillable = [
        'accepted_answer', 'title', 'content', 'post_id', 'author_id',
    ];

    /**
     * @return bool
     */
    public function isYours()
    {
        return Auth::id() == $this->author->id;
    }

    /**
     * return whether the question has an accepted answer
     *
     * @return bool
     */
    public function isAccepted()
    {
        return $this->whereHas('children', function($q) {
           $q->where('accepted_answer', 1)->where('post_id', $this->id);
        })->count() == 1;
    }

    public function isFlagged()
    {
        return $this->flags > 0 ? true : false;
    }

    public static function getFlaggedPosts()
    {
        return \App\Post::where('flags', '>', 0)->get();
    }

    /**
     * Get the author associated with the model.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /*
     * return int
     * returns the views, votes or answers.
     */
    public function getAnswerTotal()
    {
        return Post::where('post_id', $this->id)->count();
    }

    /**
     * Get the parent post associated with the model.
     */
    public function parent()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    /**
     * Get the child posts associated with the model.
     */
    public function children()
    {
        return $this->hasMany(Post::class, 'post_id');
    }

    /**
     * Get the comment posts associated with the model.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    public function posts()
    {
        return $this->belongsToMany(User::class, 'votes');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }


    public function getVotesTotal()
    {
        if ($this->votes)
        {
            return $this->votes()->sum('vote');
        }
        return 0;
    }

    public function userHasVoted()
    {
        $data = \App\Vote::where([
            ['user_id', '=', \Auth::user()->id],
            ['post_id', '=', $this->id]
        ])->get();

        return count($data);
    }

    public function getTimePosted()
    {
        $date = $this->created_at;
        $carbonDate = new Carbon($date);

        return $carbonDate->diffForHumans();
    }

    public function isAnswer()
    {
        return count($this->parent);
    }


}


