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
        Schema::create('tss_attendees_driving_exam_scores', function (Blueprint $table) {
            $table->id();

            $table->string('training_key', 50);
            $table->string('attendee_key', 50);
            $table->string('exam_key', 50);

            $table->integer('seatbelt')->nullable();
            $table->integer('contact')->nullable();
            $table->integer('horns')->nullable();
            $table->integer('skid')->nullable();

            $table->integer('controls')->nullable();
            $table->integer('handling')->nullable();
            $table->integer('time')->nullable();
            $table->integer('behavior')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tss_attendees_driving_exam_scores');
    }
};
