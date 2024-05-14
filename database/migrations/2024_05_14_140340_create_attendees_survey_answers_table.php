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
        Schema::create('tss_attendees_survey_answers', function (Blueprint $table) {
            $table->id();
            $table->string('training_key', 50);
            $table->string('attendee_key', 50);
            $table->bigInteger('question_id');
            $table->string('answer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tss_attendees_survey_answers');
    }
};
