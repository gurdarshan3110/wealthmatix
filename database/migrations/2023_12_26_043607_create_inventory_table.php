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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('variant_id');
            $table->unsignedBigInteger('store_id');
            $table->string('batch_no')->nullable();
            $table->decimal('mrp', 8, 2)->nullable();
            $table->decimal('unit_price', 8, 2)->nullable();
            $table->decimal('sale_price', 8, 2)->nullable();
            $table->integer('quantity');
            $table->boolean('type')->default(0);
            $table->date('manufacture_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->date('action_date')->nullable();

            $table->unsignedBigInteger('transfered_to')->nullable();
            $table->unsignedBigInteger('sold_to')->nullable();
            
            $table->boolean('status')->default(0);
            $table->softDeletes();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('variant_id')->references('id')->on('variants');
            $table->foreign('sold_to')->references('id')->on('users');
            $table->foreign('store_id')->references('id')->on('stores');
            $table->foreign('transfered_to')->references('id')->on('stores');
            $table->index('type');
            $table->index('status');
            $table->index('expiry_date');
            $table->index('batch_no');
            $table->index('manufacture_date');
            $table->index('action_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
};
