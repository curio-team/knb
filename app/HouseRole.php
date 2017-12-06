<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseRole extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'house_roles';

    protected $fillable = ['house_id', 'user_id', 'role_level', 'role_title'];

    /**
     * user
     * Get the post associated with the model.
     *
     * @return \Illuminate\Http\Response
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * house
     * Get the tag associated with the model.
     *
     * @return \Illuminate\Http\Response
     */
    public function house()
    {
        return $this->belongsTo(House::class);
    }
}
