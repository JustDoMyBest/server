<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    protected $guarded = [];

    public function filetype() {
        return $this->belongsTo(Filetype::class);
    }

    public function scopeFilter($query, $filters)
    {
        // dd($query,$filters);
        return $filters->apply($query);
    }
}
