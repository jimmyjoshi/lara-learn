<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('events', 'APIEventsController@index')->name('events.index');
    Route::post('events/create', 'APIEventsController@create')->name('events.create');
    Route::post('events/edit', 'APIEventsController@edit')->name('events.edit');
    Route::post('events/show', 'APIEventsController@show')->name('events.show');
    Route::post('events/delete', 'APIEventsController@delete')->name('events.delete');
});
?>