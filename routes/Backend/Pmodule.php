<?php

Route::group([
    "namespace"  => "Pmodule",
], function () {
    /*
     * Admin Pmodule Controller
     */

    // Route for Ajax DataTable
    Route::get("pmodule/get", "AdminPmoduleController@getTableData")->name("pmodule.get-list-data");

    Route::resource("pmodule", "AdminPmoduleController");
});