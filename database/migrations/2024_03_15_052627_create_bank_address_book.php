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
        Schema::create('bank_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_id')->nullable()->constrained('banks');
            $table->string('address');
            $table->string('city');

            $table->string('sales_manager');
            $table->string('sales_manager_email');
            $table->string('sales_manager_phone');

            $table->string('area_sales_manager');
            $table->string('area_sales_manager_email');
            $table->string('area_sales_manager_phone');

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
        Schema::dropIfExists('bank_addresses');
    }
};
