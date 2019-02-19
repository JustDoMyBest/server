<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

class FileFilters extends Filters
{
    protected $filters = ['by', 'title', 'tags', 'description', 'enabled'];

    public function by($username){
        if($username == '') return $this->builder;
        $user = User::where('name', $username)->firstOrfail();

        if($user) return $this->builder->where('user_id', $user->id);
        return $this->builder;
    }

    public function tags($tags){
        if($tags == '') return $this->builder;
        return $this->builder->where('tags','like', "%$tags%");
    }

    public function title($title){
        if($title == '') return $this->builder;
        return $this->builder->where('title','like', "%$title%");
    }

    public function name($name){
        if($name == '') return $this->builder;
        return $this->builder->where('name','like', "%$name%");
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