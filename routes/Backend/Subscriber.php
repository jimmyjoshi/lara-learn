<?php

Route::group([
    'namespace'  => 'Subscriber',
], function () {

    /*
     * Admin Subscriber Controller
     */
   	Route::resource('subscriber', 'AdminSubscriberController', [
        'except' => ['index', 'show']
    ]);

    Route::get('subscriber/', 'AdminSubscriberController@index')->name('subscriber.index');
    Route::get('subscriber/upload', 'AdminSubscriberController@upload')->name('
        subscriber.upload');

    Route::post('subscriber/upload/store', 'AdminSubscriberController@uploadStore')->name('subscriber.upload-store');


  	Route::get('subscriber/get', 'AdminSubscriberController@getTableData')->name('subscriber.get-list-data');
});
