<?php
Route::prefix('manager')
    ->name('manager.')
    ->namespace('Manager')
    ->group(function () {
        Route::view('/','manager.index');
        Route::get('/resumes','ResumeController@index');
        Route::resource('/bids','BidController');
        Route::put('/bids/{bid}','BidController@update');
        Route::put('/resumes/{resume}','BidController@update');
//        Route::resource('resume', 'ResumeController');
    });
