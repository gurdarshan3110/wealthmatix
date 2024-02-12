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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('gstin')->nullable();
            $table->string('contact_person')->nullable();
            $table->string('email')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('address')->nullable();
            $table->string('suburb')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();
            
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
        Schema::dropIfExists('suppliers');
    }
};
