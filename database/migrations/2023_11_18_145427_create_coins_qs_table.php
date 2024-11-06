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
        Schema::create('coins_qs', function (Blueprint $table) {
            $table->id();

            $table->text('name_ar')->nullable();
            $table->text('name_en')->nullable();
            $table->text('answer1_ar')->nullable();
            $table->text('answer1_en')->nullable();

            $table->text('answer2_ar')->nullable();
            $table->text('answer2_en')->nullable();

            $table->text('answer3_ar')->nullable();
            $table->text('answer3_en')->nullable();

            $table->text('answer4_ar')->nullable();
            $table->text('answer4_en')->nullable();

            $table->text('true_answer')->nullable();
            $table->integer('coins')->default('1')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coins_qs');
    }
};
