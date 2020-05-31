<?php

Route::prefix('employer')
    ->name('employer.')
    ->namespace('Employer')
//    ->middleware(['auth','role:1'])
    ->group(function () {
        Route::resource('bid', 'BidController');
        Route::get('/search-for-resumes','ResumeController@index');
        Route::put('/bid/{bid}','BidController@update');
        Route::get('/bid-offers/{id}','BidOffersController@index');
        Route::get('/offer/{id}','BidOffersController@createOffer');
        Route::post('/offer','BidOffersController@store');
        Route::get('/resume/{id}','ResumeController@show');
        Route::get('/offer-show/{id}','BidOffersController@show');
        Route::put('/offer/{id}','BidOffersController@changeStatus');
        Route::get('/bids','BidOffersController@getAnswers');
        Route::delete('/bids/{id}','BidOffersController@delete');
    });

Route::prefix('employee')
    ->name('employee.')
    ->namespace('Employee')
//    ->middleware(['auth','role:2'])
    ->group(function () {
        Route::resource('resume', 'ResumeController');
        Route::get('/employee-resume','ResumeController@showResume');
        Route::get('/search-for-bid','BidController@index');
        Route::get('/watch-bid/{id}','BidController@watchBid');
        Route::put('/offer/{id}','OffersController@changeStatus');
        Route::get('/watch-offer/{id}','OffersController@show');
        Route::put('/resume/{resume}','ResumeController@update');
        Route::get('/bid-offer/{id}/{resume}','BidOferController@addResume');
        Route::get('/offers/{id}','OffersController@index');
        Route::get('/send-resumes/{bid}','ResumeController@getPublicResumes');
        Route::get('/resumes','BidOferController@index');
        Route::delete('/resumes/{id}','BidOferController@delete');
    });

Route::get('/specialties','SpecialtiesController@getSpecialties') ->middleware(['auth']);



