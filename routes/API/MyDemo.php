<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('mydemo', 'APIMyDemoController@index')->name('mydemo.index');
    Route::post('mydemo/create', 'APIMyDemoController@create')->name('mydemo.create');
    Route::post('mydemo/edit', 'APIMyDemoController@edit')->name('mydemo.edit');
    Route::post('mydemo/show', 'APIMyDemoController@show')->name('mydemo.show');
    Route::post('mydemo/delete', 'APIMyDemoController@delete')->name('mydemo.delete');
});
?>