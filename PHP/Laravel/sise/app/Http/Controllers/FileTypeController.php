<?php

namespace App\Http\Controllers;

use App\FileType;
use Illuminate\Http\Request;
use App\Filters\FiletypeFilters;
use Illuminate\Http\Response;

class FiletypeController extends Controller
{
    public function __construct()
    {
        // parent::__construct();
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, FiletypeFilters $filters)
    {
        //
        // $request->session()->flash('title', $request['title']);
        $request->session()->flash('type', $request['type']);
        $request->session()->flash('description', $request['description']);
        $request->session()->flash('enabled', $request['enabled']);

        // $filetypes = $this->getModel($filters);
        $filetypes = $this->getModel(Filetype::class, $filters);
        // dd($filetypes);
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_filetype.filetype_index',[
            'filetypes' => $filetypes,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_filetype.filetype_create');
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
        // dd(auth());
        // dd(auth()->id());
        Filetype::create([
            'user_id' => auth()->id(),
            'type' => $request['type'],
            'description' => $request['description'],
            'enabled' => !!$request['enabled'],
        ]);

        return redirect('/filetype');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FileType  $fileType
     * @return \Illuminate\Http\Response
     */
    public function show(FileType $fileType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FileType  $fileType
     * @return \Illuminate\Http\Response
     */
    public function edit(Filetype $filetype)
    {
        //
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_filetype.filetype_edit', compact('filetype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FileType  $fileType
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, FileType $fileType)
    // public function update(Request $request, Filetype $model)
    public function update(Request $request, Filetype $filetype)
    {
        //
        // dd('updating',$model->id);
        // $model->update([
        // dd($this->convertEnabledToBoolean($request['enabled']));
        $filetype->update([
            'user_id' => auth()->id(),
            'type' => $request['type'],
            'description' => $request['description'],
            'enabled' => $this->convertEnabledToBoolean($request['enabled']),
        ]);

        if ($request->wantsJson()) {
            return Response([], 204);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FileType  $fileType
     * @return \Illuminate\Http\Response
     */
    // public function destroy(FileType $fileType)
    public function destroy($ids)
    {
        //
        // dd('destroying', $ids);
        $ids=is_array($ids)? $ids: (is_string($ids)? explode(',', $ids):func_get_args());
        \DB::table('filetypes')->whereIn('id',$ids)->delete();
        return redirect()->back();
    }
}
