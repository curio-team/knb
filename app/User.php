<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\HouseRole;
use App\Point;

class User extends Authenticatable
{
    use Notifiable;
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','name', 'email', 'type', 'password', 'points'
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
     * houseRole
     * Get the house role associated with the model.
     *
     * @return \Illuminate\Http\Response
     */
    public function houseRole()
    {
        return $this->hasOne(HouseRole::class, 'user_id');
    }

    /**
     * pointsSum
     * Get the sum of points associated with the model.
     * DEPRECATED
     *
     * @return \Illuminate\Http\Response
     */
    public function pointsSum()
    {
        $this->hasMany(Point::class, 'receiver_id')->sum('points');
    }

    /**
     * points
     *
     * @return \Illuminate\Http\Response
     */
    public function points()
    {
        return $this->hasMany(Point::class,'receiver_id');
    }

    /**
     * posts
     *
     * @return \Illuminate\Http\Response
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'votes');
    }

    /**
     * scorelogs
     *
     * @return \Illuminate\Http\Response
     */
    public function scorelogs()
    {
        return $this->hasMany('ScoreLog::class', 'user_id');
    }

    /**
     * isHeadMaster
     *
     * @return \Illuminate\Http\Response
     */
    public function isHeadMaster()
    {
        return $this->type == 'teacher' ? true : false;
    }

    /**
     * sortByPoints
     *
     * @param mixed $limit
     * @return \Illuminate\Http\Response
     */

    public function isEditor()
    {
        return $this->type == 'editor' ? true : false;
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
        dd($data);
    }

    /**
     * flags
     *
     * @return \Illuminate\Http\Response
     */
    public function flags()
    {
        return $this->belongsToMany(Post::class, 'flags', 'user_id', 'post_id');
    }

    /**
     * badges
     *
     * @return \Illuminate\Http\Response
     */
    public function badges()
    {
        return $this->belongsToMany(Badge::class);
    }

    /**
     * hasBadge
     *
     * @param mixed $badge_id
     * @return \Illuminate\Http\Response
     */
    public function hasBadge($badge_id) {
        return $this->badges->contains($badge_id);
    }

    /**
     * messages
     *
     * @return \Illuminate\Http\Response
     */
    public function messages()
    {
        return $this->hasMany(\App\Message::class, 'receiver_id');
    }

    /**
     * newMessageCount
     *
     * @return \Illuminate\Http\Response
     */
    public function newMessageCount()
    {
        return \App\Message::where('receiver_id', $this->id)->where('read', 0)->count();
    }


    /**
     * getHouseSingular
     *
     * @return \Illuminate\Http\Response
     */
    public function getHouseSingular()
    {
        return $this->houseRole->house->singular;
    }
    
    /**
     * getPoints
     * DEPRECATED
     *
     * @return \Illuminate\Http\Response
     */
    public function getPoints()
    {
//        return $this->id;
       $sql = "SELECT SUM(`score_types`.`points`) as total
                FROM `points`
                INNER JOIN `score_types` ON `score_types`.`id` = `points`.`score_type_id`
                LEFT JOIN `users` ON `users`.`id` = `points`.`receiver_id`
                WHERE `users`.`id` = '" . $this->id . "'";

       $points = \DB::select($sql);
       $points[0]->total += $this->points;
       return $points[0]->total;
    }

    /**
     * getForumPoints
     *
     * @return \Illuminate\Http\Response
     */
    public function getForumPoints()
    {
        $sql = "SELECT SUM(`score_types`.`points`) as total
                FROM `points`
                INNER JOIN `score_types` ON `score_types`.`id` = `points`.`score_type_id`
                LEFT JOIN `users` ON `users`.`id` = `points`.`receiver_id`
                WHERE `users`.`id` = '" . $this->id . "'";

        $points = \DB::select($sql);
        return $points[0]->total;
    }

    /**
     * getStudents
     *
     * @return \Illuminate\Http\Response
     */
    public static function getStudents()
    {
        $students = \App\User::where('type', '=', 'student')->get();

        return $students;
    }

    /**
     * addPoints
     *
     * @param mixed $points
     * @param mixed $fromDB
     * @return \Illuminate\Http\Response
     */
    public function addPoints($points, $fromDB = false)
    {

        if ($fromDB)
        {
            $point = \App\ScoreType::find($points);
            $this->points += $point->points;

        } else {
            $this->points += $points;
        }
        $this->update();
    }

    /**
     * deletePoints
     *
     * @param mixed $points
     * @param mixed $fromDB
     * @return \Illuminate\Http\Response
     */
    public function deletePoints($points, $fromDB = false) {

        if ($fromDB)
        {
            $point = \App\ScoreType::find($points);

            $this->points -= $point->points;

        } else
        {
            $this->points -= $points;
        }
        $this->update();
    }

}
