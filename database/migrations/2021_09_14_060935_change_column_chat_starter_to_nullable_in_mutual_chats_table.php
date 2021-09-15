<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeColumnChatStarterToNullableInMutualChatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mutual_chats', function (Blueprint $table) {
            $table->foreignId('chat_starter')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mutual_chats', function (Blueprint $table) {
            $table->foreignId('chat_starter')->nullable(false)->change();
        });
    }
}
