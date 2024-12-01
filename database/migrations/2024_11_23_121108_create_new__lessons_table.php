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
        Schema::create('new__lessons', function (Blueprint $table) {
            $table->id();
            $table->string('icon');
            $table->string('name');
            $table->string('stream_link');
            $table->string('video');
            $table->string('file');
            $table->string('number');
            $table->foreignId('chapter_id')->constrained('chapters')->cascadeOnDelete();
            $table->foreignId('course_id')->constrained('new_courses')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new__lessons');
    }
};
