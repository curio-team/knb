<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\HouseRole;
use App\Point;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'points'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the house role associated with the model.
     */
    public function houseRole()
    {
        return $this->hasOne(HouseRole::class, 'user_id');
    }

    /**
     * Get the sum of points associated with the model.
     * DEPRECATED
     */
    public function pointsSum()
    {
        $this->hasMany(Point::class, 'receiver_id')->sum('points');
    }

    public function points()
    {
        return $this->hasMany(Point::class,'receiver_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'votes');
    }

    public function scorelogs()
    {
        return $this->hasMany('ScoreLog::class', 'user_id');
    }

    public function isHeadMaster()
    {
        return $this->houseRole->role_level == 100 ? true : false;
    }

    public static function sortByPoints($limit = null)
    {
        $sql = "SELECT SUM(`score_types`.`points`) as total, `users`.`name` as name, `users`.`id` as id
                FROM `points`
                INNER JOIN `score_types` ON `score_types`.`id` = `points`.`score_type_id`
                LEFT JOIN `users` ON `users`.`id` = `points`.`receiver_id`
                GROUP BY `users`.`name`, `users`.`id`
                ORDER BY total DESC";


        if ($limit)
        {
            $sql.=" LIMIT $limit";
        }

        $data = \DB::select($sql);
        foreach($data as $user)
        {
            $u = \App\User::find($user->id);
            $user->total += $u->points;
        }
        usort($data, function($a, $b){
            return $b->total - $a->total;
        });



        return collect($data);

    }

    public function flags()
    {
        return $this->belongsToMany(Post::class, 'flags', 'user_id', 'post_id');
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class);
    }

    public function messages()
    {
        return $this->hasMany(\App\Message::class, 'receiver_id');
    }

    public function newMessageCount()
    {
        return \App\Message::where('receiver_id', $this->id)->where('read', 0)->count();
    }


    public function getHouseSingular()
    {
        return $this->houseRole->house->singular;
    }

    public function getPoints()
    {
//        return $this->id;
       $sql = "SELECT SUM(`score_types`.`points`) as total
                FROM `points`
                INNER JOIN `score_types` ON `score_types`.`id` = `points`.`score_type_id`
                LEFT JOIN `users` ON `users`.`id` = `points`.`receiver_id`
                WHERE `users`.`id` = " . $this->id;

       $points = \DB::select($sql);
       $points[0]->total += $this->points;
       return $points[0]->total;
    }

    public static function getStudents()
    {
        $students = \App\User::whereHas('houseRole', function($query){
            $query->where('role_level', '=', NULL);
        })->get();

        return $students;
    }

}
