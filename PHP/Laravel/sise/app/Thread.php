<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Events\ThreadHasNewReply;
// use App\User;

class Thread extends Model
{
    //
    use RecordsActivity; // 与之前相比，仅仅多了一行引用

    protected $guarded = []; // 意味所有属性均可更新，后期会修复此安全隐患
    protected $with = ['creator','channel'];
    protected $appends = ['isSubscribedTo'];

    protected static function boot()
    {
        parent::boot();

        // static::addGlobalScope('replyCount',function ($builder){
        //    $builder->withCount('replies');
        // });
    
        static::deleting(function ($thread) {
            $thread->replies->each->delete();
        });
    }

    public function path()
    {
        return "/threads/{$this->channel->slug}/{$this->id}";
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id'); // 使用 user_id 字段进行模型关联
    }

    public function channel()
    {
        return $this->belongsTo(Channel::class);
    }

    public function addReply($reply)
    {
        $reply = $this->replies()->create($reply);

        // // Prepare notifications for all subscribers
        // $this->subscriptions
        //     // ->filter (function ($sub) use ($reply){
        //     //     return $sub->user_id != $reply->user_id;
        //     // })
        //     ->where('user_id','!=',$reply->user_id)
        //     ->each
        //     ->notify($reply);

        event(new \App\Events\ThreadReceivedNewReply($reply));

        // event(new ThreadHasNewReply($this,$reply));

        // $this->notifySubscribers($reply);

        return $reply;
    }

    // public function notifySubscribers($reply)
    // {
    //     $this->subscriptions
    //         ->where('user_id','!=',$reply->user_id)
    //         ->each
    //         ->notify($reply);
    // }

    public function scopeFilter($query, $filters)
    {
        // dd($query,$filters);
        return $filters->apply($query);
    }

    public function subscribe($userId = null)
    {
        $this->subscriptions()->create([
           'user_id' => $userId ?: auth()->id()
        ]);

        return $this;
    }

    public function unsubscribe($userId = null)
    {
        $this->subscriptions()
            ->where('user_id',$userId ?: auth()->id())
            ->delete();
    }

    public function subscriptions()
    {
        return $this->hasMany(ThreadSubscription::class);
    }

    public function getIsSubscribedToAttribute()
    {
        return $this->subscriptions()
            ->where('user_id',auth()->id())
            ->exists();
    }

    public function hasUpdatesFor($user)
    {
        // Look in the cache for the proper key
        // compare that carbon instance with the $thread->updated_at

        // dd($user->visitedThreadCacheKey($this));
        $key = $user->visitedThreadCacheKey($this);

        return $this->updated_at > cache($key);
    }
}
