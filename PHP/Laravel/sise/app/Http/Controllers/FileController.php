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
    // protected static function boot()
    // {
    //     if (auth()->guest()) return;
    //     $filetypes = Filetype::all();
    //     $tags = Tag::all();
    // }

    public function __construct()
    {
        // parent::__construct();
        $this->middleware('auth');
        $this->filetypes = Filetype::all();
        $this->tags = Tag::all();
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
        File::create([
            'user_id' => auth()->id(),
            'course_id' => null,
            'filetype_id' => $request['filetype'],
            'title' => $request['title'],
            'tags' => $request['tag'],
            'description' => $request['description'],
            'file_path' => $request['file']->store('sise/files', 'public'),
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
        // return view('awesome_sharing_courses_resources.backend_BS_JQ.module_file.file_edit', compact('file'));
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_file.file_edit', [
            'file' => $file,
            'filetypes' => $this->filetypes,
            'tags' => $this->tags,
            ]);
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
        foreach($ids as $id) {
            $file = File::find($id);
            Storage::disk('public')->delete($file->file_path);
        }
        \DB::table('files')->whereIn('id',$ids)->delete();
        return redirect()->back();
    }
}
