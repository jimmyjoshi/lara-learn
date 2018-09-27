<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddReadStatusColumnToTableDataMailers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('data_mailers', function (Blueprint $table)
        {
            $table->tinyInteger('read_status')->default(0)->after('send_status');
            $table->datetime('deleted_at')->nullable()->after('updated_at');
            $table->datetime('read_at')->nullable()->after('deleted_at');
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
