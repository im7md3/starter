<?php

define('PAGINATION_COUNT',5);
Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/', function () {
    return 'Home';
})->name('home');

Route::get('/redirect/{service}', 'SocialController@redirect');
Route::get('/callback/{service}', 'SocialController@callback');



Route::group(
    [
        'prefix' => LaravelLo`calization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ],
    function () {
        Route::group(['prefix' => 'offer'], function () {
            Route::get('create', 'CrudController@create');
            Route::post('insert', 'CrudController@insert')->name('offer.insert');
            Route::get('edit/{offer_id}', 'CrudController@editOffer');
            Route::post('update/{offer_id}', 'CrudController@updateOffer')->name('offer.update');
            Route::get('delete/{offer_id}', 'CrudController@deleteOffer')->name('offer.delete');
            Route::get('all', 'CrudController@getAllOffers')->name('offer.all');
            Route::get('all/inactive', 'CrudController@getAllInactiveOffers')->name('inactive.offer');
        });
        Route::get('youtube', 'CrudController@getVideo')->middleware('auth');
    }
);

//================================== ajax offer ==============================
Route::group(['prefix' => 'ajax-offer'], function () {
    Route::get('create', 'Offercontroller@create');
    Route::post('insert', 'Offercontroller@insert')->name('ajax.offer.insert');
    Route::post('delete', 'Offercontroller@delete')->name('ajax.offer.delete');
    Route::get('edit/{offer_id}', 'Offercontroller@edit')->name('ajax.offer.edit');
    Route::post('update', 'Offercontroller@update')->name('ajax.offer.update');
    Route::get('all', 'Offercontroller@all')->name('ajax.offer.all');
});
//====================================== middleware=================================
Route::group(['middleware'=>'CheckAge'],function(){
    Route::get('adults','Auth\CustomAuthController@adult')->name('adult');
});  


Route::get('site','Auth\CustomAuthController@site')->middleware('auth')->name('site');
Route::get('iadmin','Auth\CustomAuthController@admin')->middleware('auth:admin')->name('admin');

Route::get('admin/login','Auth\CustomAuthController@adminLogin')->name('admin.login');
Route::post('admin/login','Auth\CustomAuthController@checkAdminLogin')->name('save.admin.login');

//======================================= Relations =======================================
/* ======================================×One To One ==================================== */
Route::get('has-one','relations\RelationController@hasOneRelation');
Route::get('has-one-revers','relations\RelationController@hasOneRelationRevers');
Route::get('user-has-phone','relations\RelationController@getUserHasPhone');
Route::get('user-not-has-phone','relations\RelationController@getUserNotHasPhone');
/* ======================================×One To Many ==================================== */
Route::get('hospitals','relations\RelationController@getHos')->name('hos');
Route::get('doctors/{hos_id}','relations\RelationController@getDoc')->name('doctors');
Route::get('hospitals-has-doctors','relations\RelationController@getHosHasDoc')->name('hos.has.doc');
Route::get('doctors','relations\RelationController@allDoc')->name('all.doc');
Route::get('male-doctors','relations\RelationController@maleDoc')->name('male.doc');
Route::post('hos-delete','relations\RelationController@hosDelete')->name('hos.delete');

/* ======================================Many To Many ==================================== */
Route::get('doctors-services','relations\RelationController@docSer')->name('doctors.services');
Route::get('services-doctors','relations\RelationController@serDoc')->name('services.doctors');
Route::get('doctors/services/{doc_id}','relations\RelationController@showSerForDoc')->name('showServicesForDoc');
Route::get('services','relations\RelationController@AllServices')->name('all.services');
Route::post('save-ser-to-doc','relations\RelationController@saveSerToDoc')->name('save.ser');

/* ====================================== Has One Through ==================================== */
Route::get('patients','relations\RelationController@getpatients')->name('patients');
/* ====================================== Has Manu Through ==================================== */
Route::get('Doc-Coun','relations\RelationController@docByCon')->name('docincon');


/* ====================================== Accessors ==================================== */
Route::get('accessors','relations\RelationController@getDocs')->name('access');