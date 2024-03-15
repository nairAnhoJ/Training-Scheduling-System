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
        Schema::create('tss_driving_exam_scores', function (Blueprint $table) {
            $table->id();

            $table->string('attendee_key', 50);
            $table->string('training_key', 50);

            $table->integer('driving_level')->nullable();
            $table->integer('driving_seatbelt')->nullable();
            $table->integer('driving_3ptcontact')->nullable();
            $table->integer('driving_horns')->nullable();
            $table->integer('driving_skid')->nullable();
            $table->integer('driving_controls')->nullable();
            $table->integer('driving_handling')->nullable();
            $table->integer('driving_time')->nullable();
            $table->integer('driving_behavior')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tss_driving_exam_scores');
    }
};
