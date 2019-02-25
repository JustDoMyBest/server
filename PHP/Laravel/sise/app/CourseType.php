<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coursetype extends Model
{
    //
    protected $guarded = [];

    public function courses () {
        return $this->hasMany(Course::class);
    }

    public function scopeFilter($query, $filters)
    {
        // dd($query,$filters);
        return $filters->apply($query);
    }
}
