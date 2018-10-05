<?php

Route::group([
    "namespace"  => "Config",
], function () {
    /*
     * Admin Config Controller
     */

    // Route for Ajax DataTable
    Route::get("config/get", "AdminConfigController@getTableData")->name("config.get-list-data");

    Route::resource("config", "AdminConfigController");
});