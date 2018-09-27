<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('salary', 'APISalaryController@index')->name('salary.index');
    Route::post('salary/create', 'APISalaryController@create')->name('salary.create');
    Route::post('salary/edit', 'APISalaryController@edit')->name('salary.edit');
    Route::post('salary/show', 'APISalaryController@show')->name('salary.show');
    Route::post('salary/delete', 'APISalaryController@delete')->name('salary.delete');
});
?>