<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; //为什么这个可以省略？ 默认规则是小写的模型类名复数格式作为与其对应的表名
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));

//        return "http://www.gravatar.com/avatar/$hash?s=$size";
        return "/images/medical.png";
    }


    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::creating(function ($user){
            $user->activation_token = Str::random(10);
        });
    }

    public function statuses(){
        return $this->hasMany(Status::class);//这算什么
    }

    public function feed(){
        return $this->statuses()->orderBy('created_at', 'desc');
    }

    public function followers(){
        return $this->belongsToMany(User::class,'followers','user_id','follower_id');
    }
// User::Class 不能用引号
    public function followings(){
        return $this->belongsToMany(User::class,'followers','follower_id','user_id');
    }

    public function follow($user_ids){
        if ( ! is_array($user_ids)) {
           $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids,false);
    }

    public function unfollow($user_ids){
        if ( ! is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    public function isFollowing($user_id)
    {
//        下面的语法很新鲜
        return $this->followings->contains($user_id);
    }

}
