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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            $table->foreignId('logo')->nullable()->constrained('media');
            $table->foreignId('favicon')->nullable()->constrained('media');

            $table->string('name');
            $table->string('seo_title');
            $table->string('seo_description');
            $table->string('meta_title');
            $table->string('meta_description');
            $table->string('meta_url');

            $table->string('primary_button');
            $table->string('secondary_button');
            $table->string('warning_button');
            $table->string('danger_button');

            $table->string('primary_text');
            $table->string('secondary_text');
            $table->string('warning_text');
            $table->string('danger_text');

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
        Schema::dropIfExists('settings');
    }
};
