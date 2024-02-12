<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedBigInteger('profile_picture')->nullable();
            $table->string('email')->unique();
            $table->string('phone_no')->nullable();
            $table->date('hire_date');
            $table->decimal('salary', 10, 2);
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
        Schema::dropIfExists('employees');
    }
}
