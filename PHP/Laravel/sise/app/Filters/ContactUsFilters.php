<?php

namespace App\Filters;

use App\User;
use Illuminate\Http\Request;

class ContactUsFilters extends Filters
{
    protected $filters = ['by','contact_information','text','tag','enabled'];

    public function by($username){
        if($username == '') return $this->builder;
        $user = User::where('name', $username)->firstOrfail();

        if($user) return $this->builder->where('user_id', $user->id);
        return $this->builder;
    }


    public function contact_information($contact_information){
        if($contact_information == '') return $this->builder;
        return $this->builder->where('contact_information','like', "%$contact_information%");
    }


    public function text($text){
        if($text == '') return $this->builder;
        return $this->builder->where('text','like', "%$text%");
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