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
        Schema::create('new_courses', function (Blueprint $table) {
            $table->id();
          $table->string('name');
            $table->string('photo');
            $table->string('price');
            $table->string('Discounted_Price');
            $table->string('Instructors');
            $table->string('Description');
            $table->string('Explanatory_Video');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('new_courses');
    }
};
