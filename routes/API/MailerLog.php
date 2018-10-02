<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('mailerlog', 'APIMailerLogController@index')->name('mailerlog.index');
    Route::post('mailerlog/create', 'APIMailerLogController@create')->name('mailerlog.create');
    Route::post('mailerlog/edit', 'APIMailerLogController@edit')->name('mailerlog.edit');
    Route::post('mailerlog/show', 'APIMailerLogController@show')->name('mailerlog.show');
    Route::post('mailerlog/delete', 'APIMailerLogController@delete')->name('mailerlog.delete');
});
?>