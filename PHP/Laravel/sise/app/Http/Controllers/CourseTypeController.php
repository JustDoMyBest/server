<?php

namespace App\Http\Controllers;

use App\CourseType;
use Illuminate\Http\Request;
use App\Filters\CoursetypeFilters;

class CoursetypeController extends Controller
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
    public function index(Request $request, CoursetypeFilters $filters)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_coursetype.coursetype_create');
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
        Coursetype::create([

        ]);

        return redirect('/coursetype');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CourseType  $courseType
     * @return \Illuminate\Http\Response
     */
    public function show(CourseType $courseType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CourseType  $courseType
     * @return \Illuminate\Http\Response
     */
    public function edit(Coursetype $coursetype)
    {
        //
        return view('awesome_sharing_courses_resources.backend_BS_JQ.module_filetype.filetype_edit', compact('coursetype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CourseType  $courseType
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, CourseType $courseType)
    public function update(Request $request, Coursetype $model)
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
     * @param  \App\CourseType  $courseType
     * @return \Illuminate\Http\Response
     */
    // public function destroy(CourseType $courseType)
    public function destroy($ids)
    {
        //
        dd('destroying', $ids);
    }
}
