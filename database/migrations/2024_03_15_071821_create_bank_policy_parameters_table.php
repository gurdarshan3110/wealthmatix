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
        Schema::create('bank_policy_parameters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bank_policy_id')->constrained('bank_policies')->onDelete('cascade');
            $table->foreignId('parameter_id')->constrained('parameters')->onDelete('cascade');
            $table->integer('start')->nullable();
            $table->integer('end')->nullable();
            
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
        Schema::dropIfExists('bank_policy_parameters');
    }
};
