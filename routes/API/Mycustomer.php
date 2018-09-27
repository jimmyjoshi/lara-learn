<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('mycustomer', 'APIMycustomerController@index')->name('mycustomer.index');
    Route::post('mycustomer/create', 'APIMycustomerController@create')->name('mycustomer.create');
    Route::post('mycustomer/edit', 'APIMycustomerController@edit')->name('mycustomer.edit');
    Route::post('mycustomer/show', 'APIMycustomerController@show')->name('mycustomer.show');
    Route::post('mycustomer/delete', 'APIMycustomerController@delete')->name('mycustomer.delete');
});
?>