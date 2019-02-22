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
// Route::resource('usergroup', 'UserGroupController');
Route::resource('usergroup', 'UsergroupController');
Route::resource('user', 'UserController');
// Route::resource('coursetype', 'CourseTypeController');
Route::resource('coursetype', 'CoursetypeController');
Route::resource('course', 'CourseController');
Route::resource('chapter', 'ChapterController');
// Route::resource('filetype', 'FileTypeController');
Route::resource('filetype', 'FiletypeController');
Route::resource('file', 'FileController');
Route::resource('contact_us', 'ContactUsController');

// Route::get('frontend', function () {
//     return view('awesome_sharing_courses_resources.frontend_BS_JQ.index');
// });
Route::get('frontend', 'FrontendController@index');
Route::get('frontend/courses', 'FrontendController@courses');
Route::get('frontend/files', 'FrontendController@files');
Route::get('frontend/contact_uses', 'FrontendController@contact_uses');
