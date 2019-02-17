<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    use \App\Traits\ConvertUtils;

    public function getModel($class, $filters){
        // $usergroups = UserGroup::latest()->filter($filters);
        // $model = File::latest()->filter($filters);
        $model = resolve($class)::latest()->filter($filters);

        $model = $model->paginate(5);

        return $model;
    }
}
