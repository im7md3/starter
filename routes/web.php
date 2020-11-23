<?php


Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/',function(){
    return 'Home';
});

Route::get('/redirect/{service}','SocialController@redirect');
Route::get('/callback/{service}','SocialController@callback');

Route::get('/offers','CrudController@getOffer');

Route::group(['prefix'=>'offer'],function(){
    Route::get('create','CrudController@create');
    Route::post('store','CrudController@store')->name('offer.store');
});

