<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tss_users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('id_number');
            $table->string('first_name');
            $table->string('last_name');
            $table->unsignedInteger('dept_id');
            $table->string('email');
            $table->string('role'); // 0 - ADMIN, 1 - TRAINING COORDINATOR, 2 - TRAINER, 2 - VIEWING ONLY
            $table->string('password')->default(Hash::make('password2023'));
            $table->string('color')->default('0');
            $table->string('first_time_login')->default('1');
            $table->string('is_deleted')->default('0');
            $table->string('is_active')->default('1');
            $table->string('key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tss_users');
    }
};
