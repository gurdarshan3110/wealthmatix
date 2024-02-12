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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->unsignedBigInteger('store_id');
            $table->foreign('store_id')->references('id')->on('stores');
            
            $table->string('name');
            $table->unsignedBigInteger('tax_detail_id')->nullable();
            $table->foreign('tax_detail_id')->references('id')->on('tax_details');
            $table->string('item_image')->nullable();
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')->on('units');

            $table->string('weight')->nullable();
            $table->string('size')->nullable();

            $table->boolean('status')->default(0);
            $table->softDeletes();
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
        Schema::dropIfExists('items');
    }
};
