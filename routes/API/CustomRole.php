<?php
Route::group(['namespace' => 'Api'], function()
{
    Route::get('customrole', 'APICustomRoleController@index')->name('customrole.index');
    Route::post('customrole/create', 'APICustomRoleController@create')->name('customrole.create');
    Route::post('customrole/edit', 'APICustomRoleController@edit')->name('customrole.edit');
    Route::post('customrole/show', 'APICustomRoleController@show')->name('customrole.show');
    Route::post('customrole/delete', 'APICustomRoleController@delete')->name('customrole.delete');
});
?>