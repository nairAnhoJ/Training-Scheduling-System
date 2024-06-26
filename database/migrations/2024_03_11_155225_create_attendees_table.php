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
        Schema::create('tss_attendees', function (Blueprint $table) {
            $table->id();

            $table->string('training_key', 50);
            $table->string('name', 100);
            $table->string('position', 100);
            $table->string('brand', 20);
            $table->string('type', 50);
            $table->string('knowledge', 20);
            $table->integer('years_operating');
            $table->integer('written_exam');
            $table->integer('driving_exam');
            $table->dateTime('written_exam_start');
            $table->dateTime('written_exam_end');
            $table->integer('written_score')->nullable();
            $table->integer('driving_score')->nullable();
            $table->integer('level');
            $table->string('control_number', 20)->nullable();
            $table->string('date_given', 20)->nullable();
            $table->string('key');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tss_attendees');
    }
};
