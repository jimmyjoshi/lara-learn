<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDataMailgunLog extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_smtp_server_configs', function (Blueprint $table)
        {
            $table->increments('id');
            $table->Integer('user_id');
            $table->string('domain', 255)->nullable();
            $table->string('host', 255)->nullable();
            $table->string('username', 255)->nullable();
            $table->string('password', 255)->nullable();
            $table->string('set_from', 255)->nullable();
            $table->string('set_from_name', 255)->nullable();
            $table->string('reply_to', 255)->nullable();
            $table->string('reply_to_name', 255)->nullable();
            $table->Integer('max_limit')->default(10000);
            $table->text('notes')->nullable();
            $table->Integer('status')->default(0);
            $table->timestamps();
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
