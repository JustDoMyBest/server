<?php

namespace App\Http\Controllers;

use App\File;
use App\Filetype;
use App\Tag;
use Illuminate\Http\Request;
use App\Filters\FileFilters;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
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
    public function index(Request $request, FileFilters $filters)
    {
        //
        $request->session()->flash('title', $request['title']);
        $request->session()->flash('description', $request['description']);
        $request->session()->flash('filetype', $request['filetype']);
        $request->session()->flash('tag', $request['tag']);
        $request->session()->flash('enabled', $request['enabled']);

        // $files = $this->getModel($filters);
        $files = $this->getModel(File::class, $filters);
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_file.file_index',[
            'files' => $files,
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
        $filetypes = Filetype::all();
        $tags = Tag::all();
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_file.file_create',[
            'filetypes' => $filetypes,
            'tags' => $tags,
        ]);
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
        // dd($request);
        // dd($request['files']);
        // dd($request->all());
        // foreach ($request['files'] as $file) {
        //     $file->store('files', 'public');
        // }
        Files::create([
            'user_id' => auth()->id(),
            'course_id' => null,
            'filetype_id' => $request['filetype'],
            'title' => $request['title'],
            'tags' => $request['tag'],
            'description' => $request['description'],
            'file_path' => $request['file']->store('files', 'sise', 'public'),
            'enabled' => !!$request['enabled'],
        ]);

        return redirect('/file');
   }

    /**
     * Display the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function show(File $file)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function edit(File $file)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, File $model)
    {
        //
        dd('updating',$model->id);
        $model->update([
            '' => $request[''],
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\File  $file
     * @return \Illuminate\Http\Response
     */
    // public function destroy(File $file)
    public function destroy($ids)
    {
        //
        // dd('destroying', $ids);
        $ids=is_array($ids)? $ids: (is_string($ids)? explode(',', $ids):func_get_args());
        \DB::table('files')->whereIn('id',$ids)->delete();
        foreach($ids as $id) {
            $file = File::find($id);
            Storage::disk('public')->delete($file->file_path);
        }
        return redirect()->back();
    }
}
