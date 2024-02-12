<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('hsn_code')->after('name')->nullable();
            $table->dropForeign(['store_id']);
            $table->dropForeign(['unit_id']);
            $table->dropColumn('store_id');
            $table->dropColumn('unit_id');
            $table->dropColumn('weight');
            $table->dropColumn('size');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn('hsn_code');
        });
    }
};
