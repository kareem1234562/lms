<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('course_lessons', function (Blueprint $table) {
            $table->id();
            $table->string('course_id');
            $table->string('section_id')->nullable();
            $table->string('name_ar');
            $table->string('name_en')->nullable();
            $table->text('video')->nullable();
            $table->text('file')->nullable();
            $table->integer('price')->default('0')->nullable();
            $table->integer('the_order')->default('0')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_lessons');
    }
};
