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
        Schema::create('tss_survey_questions', function (Blueprint $table) {
            $table->id();
            // $table->string('exam_key', 50);
            $table->string('type', 20); // MultipleChoice , ShortAnswer
            $table->text('question');
            // $table->string('answer', 200);
            $table->text('options')->nullable();
            // $table->integer('points');
            $table->boolean('is_deleted')->default(0);
            $table->integer('position');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tss_survey_questions');
    }
};
