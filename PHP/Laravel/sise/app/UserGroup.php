<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usergroup extends Model
{
    //
    protected $guarded = [];

    public function users(){
        return $this->hasMany(User::class);
    }

    public function scopeFilter($query, $filters)
    {
        // dd($query,$filters);
        return $filters->apply($query);
    }
}
