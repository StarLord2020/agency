<?php

Route::prefix('employer')
            ->name('employer.')
            ->namespace('Employer')
//            ->middleware(['auth','role:Админ'])
            ->group(function () {
                Route::view('/','employer.index');

                Route::resource('bid', 'BidController');
                Route::get('/search-for-resumes','ResumeController@index');
                Route::put('/bid/{bid}','BidController@update');
                Route::get('/bid-offers/{id}','BidOffersController@index');
//                Route::resource('grade', 'GradeController');
//                Route::resource('subject', 'SubjectController');
//                Route::resource('user', 'UserController');
//                Route::resource('student', 'StudentController');
//                Route::resource('subject-user', 'SubjectUserController');
//                Route::get("subject-user/index/{id}/{name}",'SubjectUserController@teachersForSubject');
//                Route::get("student/index/{id}/{name}",'StudentController@studentsForGrade');
//                Route::put("user/{user} ",'UserController@update');
//                Route::put("subject/{subject} ",'SubjectController@update');
//                Route::put("grade/{grade} ",'GradeController@update');
//                Route::put("classroom/{classroom} ",'ClassroomController@update');
//                Route::get("subject-user/create/{id}/{name} ",'SubjectUserController@createForm');
//                Route::get("student/create/{id}/{name} ",'StudentController@createForm');
            });

Route::prefix('employee')
    ->name('employee.')
    ->namespace('Employee')
    ->group(function () {
        Route::view('/','employee.index');
        Route::resource('resume', 'ResumeController');
        Route::get('/employee-resume','ResumeController@showResume');
        Route::get('/search-for-bid','BidController@index');
        Route::get('/watch-bid/{id}','BidController@watchBid');
        Route::put('/offer/{id}','OffersController@changeStatus');
        Route::get('/watch-offer/{id}','OffersController@show');
        Route::put('/resume/{resume}','ResumeController@update');
        Route::get('/bid-offer/{id}','BidOferController@addResume');
        Route::get('/offers/{id}','OffersController@index');
        Route::delete('/offer/{id}','OffersController@delete');
    });


