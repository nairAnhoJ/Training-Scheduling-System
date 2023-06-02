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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('id_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedInteger('dept_id');
            $table->foreign('dept_id')->references('id')->on('departments');
            $table->string('email');
            $table->string('role'); // 0 - ADMIN, 1 - TRAINING COORDINATOR, 2 - VIEWING ONLY
            $table->string('password')->default('$2y$10$hkGBD6legfRqJpRSTLJcUuRdEeltFB.V1vubS4NQ8OFEz3AuAwBu2');
            $table->string('color')->default('0');
            $table->string('first_time_login')->default('1');
            $table->string('is_deleted')->default('0');
            $table->string('is_active')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
