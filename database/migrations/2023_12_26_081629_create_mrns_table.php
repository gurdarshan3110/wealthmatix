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
        Schema::create('mrns', function (Blueprint $table) {
            $table->id();
            $table->string('batch_no')->unique();
            $table->string('mrn_number')->unique();
            $table->date('mrn_date');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->boolean('supplier_type')->nullable();
            $table->unsignedBigInteger('store_id')->nullable();
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('set null');

            $table->boolean('status')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('variant_mrn', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('variant_id');
            $table->foreign('variant_id')->references('id')->on('variants');
            $table->unsignedBigInteger('mrn_id');
            $table->foreign('mrn_id')->references('id')->on('mrns');
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

    public function down()
    {
        Schema::dropIfExists('variant_mrn');
        Schema::dropIfExists('mrns');
    }
};
