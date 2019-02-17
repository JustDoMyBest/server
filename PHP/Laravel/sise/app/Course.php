<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    //
    protected $guarded = [];

    public function coursetype() {
        return $this->belongsTo(Coursetype::class);
    }

    public function scopeFilter($query, $filters)
    {
        // dd($query,$filters);
        return $filters->apply($query);
    }
}
