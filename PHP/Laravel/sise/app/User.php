<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar_path', 'enabled', 'usergroup_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'email',
    ];

    // public function getRouteKeyName()
    // {
    //     return 'name';
    // }

    public function threads()
    {
        return $this->hasMany(Thread::class)->latest();
    }

    public function lastReply()
    {
        return $this->hasOne(Reply::class)->latest();
    }

    public function activity()
    {
        return $this->hasMany(Activity::class);
    }

    public function usergroup()
    {
        // return $this->hasOne(Usergroup::class, ['id' => $this->id])->latest();
        return $this->belongsTo(Usergroup::class);
    }

    public function read($thread)
    {
        cache()->forever(
            $this->visitedThreadCacheKey($thread),
            \Carbon\Carbon::now()
        );
    }

    // public function avatar()
    // {
    //     return $this->avatar_path ?: 'avatars/default.jpg';
    // }

    public function getAvatarPathAttribute($avatar)
    {
        return $avatar ?: 'avatars/default.jpg';
    }

    public function visitedThreadCacheKey($thread)
    {
        return $key = sprintf("users.%s.visits.%s",$this->id,$thread->id);
    }

    public function scopeFilter($query, $filters)
    {
        // dd($query,$filters);
        return $filters->apply($query);
    }    
}
