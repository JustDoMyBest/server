<?php

namespace App\Http\Controllers;

// use App\FileType;
use Illuminate\Http\Request;
// use App\Filters\FiletypeFilters;
use Illuminate\Http\Response;

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
    public function courses(Request $request)
    {
        //
        return view('awesome_sharing_courses_resources.frontend_BS_JQ.courses',[]);
    }
    public function files(Request $request)
    {
        //
        return view('awesome_sharing_courses_resources.frontend_BS_JQ.files',[]);
    }
    public function contact_uses(Request $request)
    {
        //
        return view('awesome_sharing_courses_resources.frontend_BS_JQ.contact',[]);
    }
}
