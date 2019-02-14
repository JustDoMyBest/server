<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

class UserFilters extends Filters
{
    protected $filters = ['by', 'name', 'email', 'enabled'];

    public function by($username){
        if($username == '') return $this->builder;
        $user = User::where('name', $username)->firstOrfail();

        if($user) return $this->builder->where('user_id', $user->id);
        return $this->builder;
    }

    public function name($name){
        if($name == '') return $this->builder;
        return $this->builder->where('name','like', "%$name%");
    }

    public function email($email){
        if($email == '') return $this->builder;
        return $this->builder->where('email','like', "%$email%");
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