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

    public $stringaction = ["Unflagged","Flagged", "Edit", "Removed"];

    public function flagger()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function GetAction()
    {
        return $this->stringaction[$this->action];
    }

}
