<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnsToNotNullableInChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('channels', function (Blueprint $table) {
            $table->foreignId('ad_id')->nullable('false')->change();
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
        Schema::table('not_nullable_in_channel', function (Blueprint $table) {
            $table->foreignId('ad_id')->nullable()->change();
            $table->foreignId('user_id')->nullable()->change();
        });
    }
}
