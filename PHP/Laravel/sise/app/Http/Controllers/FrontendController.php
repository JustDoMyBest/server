<?php

namespace App\Http\Controllers;

// use App\FileType;
use Illuminate\Http\Request;
// use App\Filters\FiletypeFilters;
use Illuminate\Http\Response;
use App\Coursetype;
use App\Course;
use App\Filetype;

class FrontendController extends Controller
{
    // public function __construct()
    // {
    //     $this->coursetypes = \DB::table('coursetypes')->get();
    //     $this->filetypes = \DB::table('filetypes')->get();
        
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $filetypes = $this->getModel($filters);
        // $filetypes = $this->getModel(Filetype::class, $filters);
        // dd($filetypes);
        // return view('awesome_sharing_courses_resources.frontend_BS_JQ.index',[
            // 'coursetypes' => $this->coursetypes,
            // 'filetypes' => $this->filetypes,
        // ]);
        return view('awesome_sharing_courses_resources.frontend_BS_JQ.index',[]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FileType  $fileType
     * @return \Illuminate\Http\Response
     */
    public function courses(Request $request, Coursetype $coursetype)
    {
        //
        // dd($request->all());
        // dd($coursetype->courses);
        // dd($coursetype);
        // $courses = $coursetype->courses->where('enabled', 1);
        $courses = \DB::table('courses')->where('coursetype_id', $coursetype->id)->where('enabled', 1)->paginate(60);
        // dd($courses);
        return view('awesome_sharing_courses_resources.frontend_BS_JQ.courses',[
            'coursetype' => $coursetype,
            // 'courses' => $coursetype->courses,
            'courses' => $courses,
        ]);
    }
    public function course_single(Request $request, Coursetype $coursetype, Course $course)
    {
        //
        // dd($request->all());
        // dd($coursetype->courses);
        // dd($coursetype->courses);
        // dd($course);
        return view('awesome_sharing_courses_resources.frontend_BS_JQ.course-single',[
            'courses' => $coursetype->courses,
            'course' => $course,
        ]);
    }
    public function files(Request $request, Filetype $filetype)
    {
        //
        // dd($request->all());
        // dd($filetype->files);
        $files = \DB::table('files')->where('filetype_id', $filetype->id)->where('enabled', 1)->paginate(60);
        return view('awesome_sharing_courses_resources.frontend_BS_JQ.files',[
            'filetype' => $filetype,
            // 'files' => $filetype->files,
            'files' => $files,
        ]);
    }
    // public function file_single(Request $request, Filetype $filetype, File $file)
    // {
    //     //
    //     // dd($request->all());
    //     // dd($coursetype->courses);
    //     // dd($coursetype->courses);
    //     // dd($course);
    //     return view('awesome_sharing_courses_resources.frontend_BS_JQ.course-single',[
    //         // 'courses' => $coursetype->courses,
    //         'file' => $file,
    //     ]);
    // }
    public function contact_uses(Request $request)
    {
        //
        return view('awesome_sharing_courses_resources.frontend_BS_JQ.contact',[]);
    }
    public function search(Request $request)
    {
        //
        // dd($request->all());
        $request->session()->flash('text', $request['text']);
        // $courses = \DB::table('courses')->where('title', 'like', '%'.$request['text'].'%')->get();
        $courses = \DB::table('courses')->where('title', 'like', '%'.$request['text'].'%')->take(12)->get();
        // $courses = \DB::table('courses')->where('title', 'like', "%$request['text']%")->get();
        // $coursetypes = \DB::table('coursetypes')->get();
        $files = \DB::table('files')->where('title', 'like', '%'.$request['text'].'%')->whereNull('course_id')->take(12)->get();
        return view('awesome_sharing_courses_resources.frontend_BS_JQ.search',[
            'courses' => $courses,
            // 'coursetype' => $coursetype,
            'files' => $files,
        ]);
    }
}
