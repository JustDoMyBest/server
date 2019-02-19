<?php

namespace App\Http\Controllers;

use App\Course;
use App\Coursetype;
use App\Tag;
use Illuminate\Http\Request;
use App\Filters\CourseFilters;

class CourseController extends Controller
{
    public function __construct()
    {
        // parent::__construct();
        $this->middleware('auth');
        $this->coursetypes = Coursetype::all();
        $this->tags = Tag::all();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, CourseFilters $filters)
    {
        //
        $request->session()->flash('title', $request['title']);
        $request->session()->flash('description', $request['description']);
        $request->session()->flash('coursetype', $request['coursetype']);
        $request->session()->flash('tag', $request['tag']);
        $request->session()->flash('enabled', $request['enabled']);

        // $files = $this->getModel($filters);
        $courses = $this->getModel(Course::class, $filters);
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_course.course_index',[
            'courses' => $courses,
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
        $coursetypes = Coursetype::all();
        $tags = Tag::all();
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_course.course_create',[
            'coursetypes' => $coursetypes,
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
        dd($request->all());
        Course::create([

        ]);

        return redirect('/course');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show(Course $course)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        //
        // return view('awesome_sharing_courses_resources.backend_BS_JQ.module_course.course_edit', compact('course'));
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_course.course_edit', [
            'course' => $course,
            'coursetypes' => $this->coursetypes,
            'tags' => $this->tags,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        //
        // dd('updating',$model->id);
        // $model->update([
        // $course->update([
        //     '' => $request[''],
        // ]);
        if($this->store($request)){
            $this->destroy($course->id);
        }
        return '<h2 align="center">更新成功</h2>';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Course  $course
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Course $course)
    public function destroy($ids)
    {
        //
        $ids=is_array($ids)? $ids: (is_string($ids)? explode(',', $ids):func_get_args());
        foreach($ids as $id) {
            $course = Course::find($id);
            foreach($course->files as $file){
                Storage::disk('public')->delete($file->file_path);
                \DB::table('files')->where('id',$file->id)->delete();
            }
        }
        \DB::table('courses')->whereIn('id',$ids)->delete();
        return redirect()->back();
    }
}
