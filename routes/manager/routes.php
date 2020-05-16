<?php
Route::prefix('manager')
    ->name('manager.')
    ->namespace('Manager')
    ->group(function () {
        Route::view('/','manager.index');
        Route::resource('/resumes','ResumeController');
        Route::resource('/bids','BidController');
        Route::resource('/specialties','SpecialtyController');
        Route::put("specialties/{specialty}",'SpecialtyController@update');
        Route::put('/bids/{bid}','BidController@update');
        Route::put('/resumes/{resume}','ResumeController@update');
//        Route::resource('resume', 'ResumeController');
    });
