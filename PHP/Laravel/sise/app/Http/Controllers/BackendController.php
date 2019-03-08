<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class BackendController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    use \App\Traits\ConvertUtils;

    // public function __construct()
    // {
        //parent::__construct();
        // dd(Auth::user()->id);
        // if(Auth::user() !=null && Auth::user()->getId()===1){
        //     redirect('/frontend');
        // }
    // }

    public function getModel($class, $filters){
        // $usergroups = UserGroup::latest()->filter($filters);
        // $model = File::latest()->filter($filters);
        $model = resolve($class)::latest()->filter($filters);

        $model = $model->paginate(5);

        return $model;
    }
}
