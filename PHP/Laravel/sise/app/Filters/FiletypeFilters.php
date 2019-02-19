<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

class FiletypeFilters extends Filters
{
    protected $filters = ['by', 'title', 'description', 'enabled'];

    public function by($username){
        if($username == '') return $this->builder;
        $user = User::where('name', $username)->firstOrfail();

        if($user) return $this->builder->where('user_id', $user->id);
        return $this->builder;
    }

    public function title($title){
        if($title == '') return $this->builder;
        return $this->builder->where('title','like', "%$title%");
    }

    public function description($description){
        if($description == '') return $this->builder;
        return $this->builder->where('description','like', "%$description%");
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