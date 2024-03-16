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
        Schema::create('tss_written_exams', function (Blueprint $table) {
            $table->id();
            $table->string('type', 20); // MultipleChoice , ShortAnswer , TrueOrFalse , Enumeration
            $table->text('question');
            $table->string('answer', 200);
            $table->text('options')->nullable();
            $table->integer('points');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tss_written_exams');
    }
};
