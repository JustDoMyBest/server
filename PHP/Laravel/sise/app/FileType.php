<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Filetype extends Model
{
    //
    protected $guarded = [];

    public function files () {
        return $this->hasMany(File::class);
    }

    public function scopeFilter($query, $filters)
    {
        // dd($query,$filters);
        return $filters->apply($query);
    }
}
