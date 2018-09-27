<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('finaldemo', 'APIFinalDemoController@index')->name('finaldemo.index');
    Route::post('finaldemo/create', 'APIFinalDemoController@create')->name('finaldemo.create');
    Route::post('finaldemo/edit', 'APIFinalDemoController@edit')->name('finaldemo.edit');
    Route::post('finaldemo/show', 'APIFinalDemoController@show')->name('finaldemo.show');
    Route::post('finaldemo/delete', 'APIFinalDemoController@delete')->name('finaldemo.delete');
});
?>