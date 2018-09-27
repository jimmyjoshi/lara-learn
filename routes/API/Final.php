<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('final', 'APIFinalController@index')->name('final.index');
    Route::post('final/create', 'APIFinalController@create')->name('final.create');
    Route::post('final/edit', 'APIFinalController@edit')->name('final.edit');
    Route::post('final/show', 'APIFinalController@show')->name('final.show');
    Route::post('final/delete', 'APIFinalController@delete')->name('final.delete');
});
?>