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
        Schema::create('tss_driving_exam_layouts', function (Blueprint $table) {
            $table->id();
            $table->string('driving_exam_key', 50);
            $table->string('name', 100)->nullable();
            $table->string('color', 10);
            $table->string('top');
            $table->string('left');
            $table->string('height');
            $table->string('width');
            $table->string('width_ratio');
            $table->string('height_ratio');
            $table->string('left_ratio');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tss_driving_exam_layouts');
    }
};
