<?php

Route::group([
    "namespace"  => "Demo",
], function () {
    /*
     * Admin Demo Controller
     */

    // Route for Ajax DataTable
    Route::get("demo/get", "AdminDemoController@getTableData")->name("demo.get-list-data");

    Route::resource("demo", "AdminDemoController");
});