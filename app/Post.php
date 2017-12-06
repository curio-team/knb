<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use \Carbon\Carbon;

class Post extends Model
{
    use SoftDeletes;
    /**
     * $dates
     *
     * @var array
     */
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
     * isYours
     *
     * @return bool
     */
    public function isYours()
    {
        return Auth::id() == $this->author->id;
    }

    /**
     * isAccepted
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

    /**
     * isFlagged
     *
     * @return \Illuminate\Http\Response
     */
    public function isFlagged()
    {
        return $this->flags > 0 ? true : false;
    }

    /**
     * isLocked
     *
     * @return \Illuminate\Http\Response
     */
    public function isLocked()
    {
        return $this->locked ? true : false;
    }

    /**
     * getFlaggedPosts
     *
     * @return \Illuminate\Http\Response
     */
    public static function getFlaggedPosts()
    {
        return \App\Post::where('flags', '>', 0)->get();
    }

    /**
     * author
     * Get the author associated with the model.
     *
     * @return \Illuminate\Http\Response
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    /**
     * getAnswerTotal
     *
     * @return \Illuminate\Http\Response
     */
    public function getAnswerTotal()
    {
        return Post::where('post_id', $this->id)->count();
    }

    /**
     * parent
     * Get the parent post associated with the model.
     *
     * @return \Illuminate\Http\Response
     */
    public function parent()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    /**
     * children
     * Get the child posts associated with the model.
     *
     * @return \Illuminate\Http\Response
     */
    public function children()
    {
        return $this->hasMany(Post::class, 'post_id');
    }

    /**
     * comments
     * Get the comment posts associated with the model.
     *
     * @return \Illuminate\Http\Response
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * tags
     *
     * @return \Illuminate\Http\Response
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tags');
    }

    /**
     * posts
     *
     * @return \Illuminate\Http\Response
     */
    public function posts()
    {
        return $this->belongsToMany(User::class, 'votes');
    }

    /**
     * votes
     *
     * @return \Illuminate\Http\Response
     */
    public function votes()
    {
        return $this->hasMany(Vote::class);
    }


    /**
     * getVotesTotal
     *
     * @return \Illuminate\Http\Response
     */
    public function getVotesTotal()
    {
        if ($this->votes)
        {
            return $this->votes()->sum('vote');
        }
        return 0;
    }

    /**
     * userHasVoted
     *
     * @return \Illuminate\Http\Response
     */
    public function userHasVoted()
    {
        $data = \App\Vote::where([
            ['user_id', '=', \Auth::user()->id],
            ['post_id', '=', $this->id]
        ])->get();

        return count($data);
    }

    /**
     * getTimePosted
     *
     * @return \Illuminate\Http\Response
     */
    public function getTimePosted()
    {
        $date = $this->created_at;
        $carbonDate = new Carbon($date);

        return $carbonDate->diffForHumans();
    }

    /**
     * isAnswer
     *
     * @return \Illuminate\Http\Response
     */
    public function isAnswer()
    {
        return count($this->parent);
    }


}


