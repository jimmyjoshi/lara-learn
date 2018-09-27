<?php

Route::group([
    "namespace"  => "Customer",
], function () {
    /*
     * Admin Customer Controller
     */
    Route::get("customer/get/", "AdminCustomerController@getTableData")->name("customer.get-list-data");
    Route::resource("customer", "AdminCustomerController");
    //Route::get("customer/", "AdminCustomerController@index")->name("customer.index");
});