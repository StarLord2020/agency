<?php
Route::prefix('manager')
    ->name('manager.')
    ->namespace('Manager')
    ->middleware(['auth','role:3'])
    ->group(function () {
        Route::resource('/resumes','ResumeController');
        Route::resource('/bids','BidController');
        Route::resource('/specialties','SpecialtyController');
        Route::put("specialties/{specialty}",'SpecialtyController@update');
        Route::put('/bids/{bid}','BidController@update');
        Route::put('/resumes/{resume}','ResumeController@update');
//        Route::resource('resume', 'ResumeController');
    });
Route::get('/statistic','Statistic\ChartController@index')->middleware(['auth']);
Route::get('/statistic/{id}','Statistic\ChartController@getStatistic')->middleware(['auth']);
Route::get('/statistic-salary/{id}','Statistic\ChartController@getStatisticSalaryForSpecialty')->middleware(['auth']);
