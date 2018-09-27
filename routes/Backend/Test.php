<?php

Route::group([
    "namespace"  => "Test",
], function () {
    /*
     * Admin Test Controller
     */
    Route::resource("test", "AdminTestController");

    Route::get("/", "AdminTestController@index")->name("test.index");
    Route::get("/get", "AdminTestController@getTableData")->name("test.get-list-data");
});