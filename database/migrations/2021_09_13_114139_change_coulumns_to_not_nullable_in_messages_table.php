<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeCoulumnsToNotNullableInMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('channel_id')->nullable('false')->change();
            $table->foreignId('user_id')->nullable('false')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->foreignId('channel_id')->nullable()->change();
            $table->foreignId('user_id')->nullable()->change();
        });
    }
}
