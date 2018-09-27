<?php

Route::group([
    "namespace"  => "CustomRole",
], function () {
    /*
     * Admin CustomRole Controller
     */

    // Route for Ajax DataTable
    Route::get("customrole/get", "AdminCustomRoleController@getTableData")->name("customrole.get-list-data");

    Route::resource("customrole", "AdminCustomRoleController");
});