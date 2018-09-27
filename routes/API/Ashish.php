<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('ashish', 'APIAshishController@index')->name('ashish.index');
    Route::post('ashish/create', 'APIAshishController@create')->name('ashish.create');
    Route::post('ashish/edit', 'APIAshishController@edit')->name('ashish.edit');
    Route::post('ashish/show', 'APIAshishController@show')->name('ashish.show');
    Route::post('ashish/delete', 'APIAshishController@delete')->name('ashish.delete');
});
?>