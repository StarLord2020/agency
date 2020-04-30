<?php

Route::prefix('employer')
            ->name('employer.')
            ->namespace('Employer')
//            ->middleware(['auth','role:Админ'])
            ->group(function () {
                Route::view('/','employer.index');

                Route::resource('bid', 'BidController');
                Route::get('/search-for-resumes','ResumeController@index');
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
    });

Route::prefix('manager')
    ->name('manager.')
    ->namespace('Manager')
    ->group(function () {
        Route::view('/','manager.index');
        Route::get('/resumes','ResumeController@index');
        Route::get('/bids','BidController@index');
//        Route::resource('resume', 'ResumeController');
    });

