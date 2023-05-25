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
            $table->string('role');
            $table->string('password');
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
