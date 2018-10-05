<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStaticsToSubscriberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_subscribers', function (Blueprint $table)
        {
            $table->Integer('total_mails')->after('category_id')->default(0)->nullable();
            $table->Integer('total_success')->after('total_mails')->default(0)->nullable();
            $table->Integer('total_fail')->after('total_success')->default(0)->nullable();
            $table->Integer('total_read')->after('total_fail')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
