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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->string('bill_number')->unique();
            $table->date('bill_date');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('transfered_to')->nullable();
            $table->boolean('type')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('set null');

            $table->boolean('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('variant_bill', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('variant_id');
            $table->foreign('variant_id')->references('id')->on('variants');
            $table->string('batch_no')->nullable();
            $table->unsignedBigInteger('bill_id');
            $table->foreign('bill_id')->references('id')->on('bills');
            $table->integer('quantity');
            $table->decimal('mrp', 8, 2)->nullable();
            $table->decimal('unit_price', 8, 2)->nullable();
            $table->decimal('sale_price', 8, 2)->nullable();
            $table->date('manufacture_date')->nullable();
            $table->date('expiry_date')->nullable();
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
        Schema::dropIfExists('bills');
        Schema::dropIfExists('variant_bill');
    }
};
