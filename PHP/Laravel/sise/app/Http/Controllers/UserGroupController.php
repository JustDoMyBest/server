<?php

namespace App\Http\Controllers;

use App\Usergroup;
use Illuminate\Http\Request;
use App\Filters\UsergroupFilters;

class UsergroupController extends Controller
{
    // use \App\Traits\ConvertUtils;
    public function __construct()
    {
        // $this->middleware('auth')->only('index');
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, UsergroupFilters $filters)
    {
        //
        $request->session()->flash('name', $request['name']);
        $request->session()->flash('description', $request['description']);
        $request->session()->flash('enabled', $request['enabled']);

        // $usergroups = $this->getUsergroup($filters);
        $usergroups = $this->getModel(UserGroup::class, $filters);
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_usergroup.usergroup_index',[
            // 'users' => $users,
            'usergroups' => $usergroups,
        ]);
    }

    // public function getUsergroup(UsergroupFilters $filters){
    // public function getModel(UsergroupFilters $filters){
    //     // $usergroups = UserGroup::latest()->filter($filters);
    //     $model = Usergroup::latest()->filter($filters);

    //     $model = $model->paginate(5);

    //     return $model;
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_usergroup.usergroup_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // dd('storing');

        UserGroup::create([
            'name' => $request['name'],
            'description' => $request['description'],
            'enabled' => !!$request['enabled'],
        ]);

        return redirect('/usergroup');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function show(Usergroup $usergroup)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function edit(Usergroup $usergroup)
    {
        //
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_usergroup.usergroup_edit', compact('usergroup'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usergroup $usergroup)
    {
        //
        $enabled = $this->ConvertEnabledToBoolean($request['enabled']);
        $usergroup->update([
            'name' => $request['name'],
            'description' => $request['description'],
            'enabled' => $enabled,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Usergroup $usergroup)
    public function destroy($ids)
    {
        //
        $ids=is_array($ids)? $ids: (is_string($ids)? explode(',', $ids):func_get_args());
        \DB::table('usergroups')->whereIn('id',$ids)->delete();
        return redirect()->back();
    }
}
