<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('config', 'APIConfigController@index')->name('config.index');
    Route::post('config/create', 'APIConfigController@create')->name('config.create');
    Route::post('config/edit', 'APIConfigController@edit')->name('config.edit');
    Route::post('config/show', 'APIConfigController@show')->name('config.show');
    Route::post('config/delete', 'APIConfigController@delete')->name('config.delete');
});
?>