<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Filters\UserFilters;
use App\Usergroup;

class UserController extends Controller
{
    use \App\Traits\ConvertUtils;
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
    public function index(Request $request, UserFilters $filters)
    {
        //
        $request->session()->flash('name', $request['name']);
        $request->session()->flash('email', $request['email']);
        $request->session()->flash('enabled', $request['enabled']);

        $users = $this->getUser($filters);
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_user.user_index',[
            'users' => $users,
        ]);
    }

    public function getUser(UserFilters $filters){
        $users = User::latest()->filter($filters);

        $users = $users->paginate(5);

        return $users;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_user.user_create', compact('user'));
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
        // dd($request['enabled']);
        
        User::create([
            // 'user_id' => auth()->id(),
            'name' => request('name'),
            'email' => request('email'),
            'password' => request('password'),
            'enabled' => !!request('enabled')
        ]);

        return redirect('/user');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    // public function show(UserGroup $userGroup)
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    // public function edit(UserGroup $userGroup)
    public function edit(User $user)
    {
        //
        // dd('editting');
        $usergroups = Usergroup::all();
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_user.user_edit', compact('user', 'usergroups'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, UserGroup $userGroup)
    public function update(Request $request, User $user)
    {
        //
        $enabled = $this->convertEnabledToBoolean($request['enabled']);
        // $usergroup = Usergroup::find($request['usergroup']);
        // $user->usergroup()->create($usergroup);
        // dd($enabled);
        // dd($user);
        // dd($request['usergroup']);
        // dd($usergroup);
        $user->update([
            'name' => $request['name'],
            'email' => $request['email'],
            'usergroup_id' => $request['usergroup'],
            'enabled' => $enabled,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\UserGroup  $userGroup
     * @return \Illuminate\Http\Response
     */
    // public function destroy(UserGroup $userGroup)
    // public function destroy(User $user)
    public function destroy($ids)
    {
        //
        $ids=is_array($ids)? $ids: (is_string($ids)? explode(',', $ids):func_get_args());
        // dd($ids);
        \DB::table('users')->whereIn('id',$ids)->delete();
        // Tag::delete($ids);
        // $tag->delete();
        return redirect()->back();
    }
}
