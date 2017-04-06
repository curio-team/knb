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
     * Get the member roles associated with the model.
     */
    public function memberRoles()
    {
        return $this->hasMany(HouseRole::class);
    }

    /**
     * Get the headMaster associated with the model.
     */
    public function headmaster()
    {
        return $this->memberRoles->where('role_level', self::ROLE_LEVEL_HEADMASTER)->first()->user;
    }

    /**
     * Get the total sum of points from all members
     */
    public function pointsSum()
    {
        $sum = 0;

        foreach($this->memberRoles as $memberRole){
            $sum += $memberRole->user->pointsSum();
        }

        return $sum;
    }
}
