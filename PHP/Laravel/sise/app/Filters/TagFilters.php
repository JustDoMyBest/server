<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

class TagFilters extends Filters
{
    protected $filters = ['by','tag','enabled'];

    public function by($username){
        if($username == '') return $this->builder;
        $user = User::where('name', $username)->firstOrfail();

        if($user) return $this->builder->where('user_id', $user->id);
        return $this->builder;
    }

    public function tag($tag){
        if($tag == '') return $this->builder;
        return $this->builder->where('tag','like', "%$tag%");
    }
    
    public function enabled($enabled){
        // dd($enabled);
        switch($enabled){
            case 'all': return $this->builder; 
            case '00': return $this->builder->where('enabled', false); 
            case '1': return $this->builder->where('enabled', true); 
        }
    }
}