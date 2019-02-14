<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    //
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    // public function enabled(){
    //     switch($this->enabled){
    //         // case 'all': return $this->builder; 
    //         // case '00': return $this->builder->where('enabled', false); 
    //         // case '1': return $this->builder->where('enabled', true); 
    //         case true: return '1';
    //         case false: return '00';
    //     }
    // }

    public function scopeFilter($query, $filters)
    {
        // dd($query,$filters);
        return $filters->apply($query);
    }
}
