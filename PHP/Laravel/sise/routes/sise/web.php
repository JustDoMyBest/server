<?php

Route::get('backend', function () {
    // return 'Hello';
    return view('awesome_sharing_courses_resources.backend_BS_JQ.index');
    // return view('awesome_sharing_courses_resources.backend_BS_JQ.introduce');
    // return view('awesome_sharing_courses_resources.backend.manage_cources');
})->middleware('auth');
Route::get('introduce', function () {
    // return 'Hello';
    // return view('awesome_sharing_courses_resources.backend_BS_JQ.index');
    return view('awesome_sharing_courses_resources.backend_BS_JQ.introduce');
});
Route::get('house_list', function () {
    // return 'Hello';
    // return view('awesome_sharing_courses_resources.backend_BS_JQ.index');
    return view('awesome_sharing_courses_resources.backend_BS_JQ.house_list');
});
Route::get('loupanchart', function () {
    // return 'Hello';
    // return view('awesome_sharing_courses_resources.backend_BS_JQ.index');
    return view('awesome_sharing_courses_resources.backend_BS_JQ.loupanchart');
});
Route::resource('tag', 'TagController');
Route::resource('coursetype', 'CourseTypeController');
Route::resource('course', 'CourseController');
Route::resource('chapter', 'ChapterController');
Route::resource('filetype', 'FileTypeController');
Route::resource('file', 'FileController');
