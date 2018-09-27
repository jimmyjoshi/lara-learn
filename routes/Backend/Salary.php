<?php

Route::group([
    "namespace"  => "Salary",
], function () {
    /*
     * Admin Salary Controller
     */

    // Route for Ajax DataTable
    Route::get("salary/get", "AdminSalaryController@getTableData")->name("salary.get-list-data");

    Route::resource("salary", "AdminSalaryController");
});