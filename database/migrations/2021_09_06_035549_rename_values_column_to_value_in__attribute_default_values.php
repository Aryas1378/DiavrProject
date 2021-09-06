<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameValuesColumnToValueInAttributeDefaultValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attribute_default_values', function (Blueprint $table) {
            $table->renameColumn('values', 'value');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('value_in__attribute_default_values', function (Blueprint $table) {
            $table->renameColumn('value', 'values');
        });
    }
}
