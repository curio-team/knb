<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    /**
     * The roles a member can have with this model.
     *
     * @var integer
     */
    const ROLE_LEVEL_MEMBER = 0;
    const ROLE_LEVEL_HEADMASTER = 100;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'houses';

    /**
     * Get the members associated with the model.
     */
    public function members()
    {
        return $this->belongsToMany('App\User', 'house_roles')
            ->withPivot(['role_level', 'role_title'])
            ->withTimestamps();
    }
}
