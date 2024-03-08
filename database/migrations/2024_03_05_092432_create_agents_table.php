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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->string('agent_code');
            $table->string('name');
            $table->string('phone_no')->unique();
            $table->string('email')->unique();
            $table->string('residential_address')->nullable();
            $table->string('office_address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('gst_no')->nullable();
            $table->string('account_no')->nullable();
            $table->string('ifsc')->nullable();
            $table->string('bank')->nullable();
            $table->string('branch')->nullable();
            $table->string('pan')->nullable();
            $table->foreignId('pan_id')->nullable()->constrained('media');
            $table->string('aadhar')->nullable();
            $table->string('aadhar_id')->nullable();
            $table->foreignId('bank_cancel_cheque')->nullable()->constrained('media');
            $table->foreignId('agency_id')->constrained('agencies');

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
        Schema::dropIfExists('agents');
    }
};
