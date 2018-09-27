<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('fakesh', 'APIFakeshController@index')->name('fakesh.index');
    Route::post('fakesh/create', 'APIFakeshController@create')->name('fakesh.create');
    Route::post('fakesh/edit', 'APIFakeshController@edit')->name('fakesh.edit');
    Route::post('fakesh/show', 'APIFakeshController@show')->name('fakesh.show');
    Route::post('fakesh/delete', 'APIFakeshController@delete')->name('fakesh.delete');
});
?>