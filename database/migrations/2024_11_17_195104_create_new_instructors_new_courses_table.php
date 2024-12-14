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
        Schema::create('new_instructors_new_courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('new_instructors_id');
            $table->unsignedBigInteger('new_courses_id');
            $table->foreignId('new_instructors_id')->constrained('new_courses')->onDelete('cascade');
            $table->foreignId('new_courses_id')->constrained('new_instructors')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_instructors_new_courses');
    }
};
