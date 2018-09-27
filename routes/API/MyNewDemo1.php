<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('mynewdemo1', 'APIMyNewDemo1Controller@index')->name('mynewdemo1.index');
    Route::post('mynewdemo1/create', 'APIMyNewDemo1Controller@create')->name('mynewdemo1.create');
    Route::post('mynewdemo1/edit', 'APIMyNewDemo1Controller@edit')->name('mynewdemo1.edit');
    Route::post('mynewdemo1/show', 'APIMyNewDemo1Controller@show')->name('mynewdemo1.show');
    Route::post('mynewdemo1/delete', 'APIMyNewDemo1Controller@delete')->name('mynewdemo1.delete');
});
?>