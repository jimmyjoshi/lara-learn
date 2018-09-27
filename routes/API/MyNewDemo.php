<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('mynewdemo', 'APIMyNewDemoController@index')->name('mynewdemo.index');
    Route::post('mynewdemo/create', 'APIMyNewDemoController@create')->name('mynewdemo.create');
    Route::post('mynewdemo/edit', 'APIMyNewDemoController@edit')->name('mynewdemo.edit');
    Route::post('mynewdemo/show', 'APIMyNewDemoController@show')->name('mynewdemo.show');
    Route::post('mynewdemo/delete', 'APIMyNewDemoController@delete')->name('mynewdemo.delete');
});
?>