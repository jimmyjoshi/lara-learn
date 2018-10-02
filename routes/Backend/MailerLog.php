<?php

Route::group([
    "namespace"  => "MailerLog",
], function () {
    /*
     * Admin MailerLog Controller
     */

    // Route for Ajax DataTable
    Route::get("mailerlog/get", "AdminMailerLogController@getTableData")->name("mailerlog.get-list-data");

    Route::resource("mailerlog", "AdminMailerLogController");
});