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
        Schema::create('tss_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('table');
            $table->string('table_key');
            $table->string('action'); // SET, EDIT, DELETE
            $table->string('description');
            $table->string('field')->nullable();
            $table->string('before')->nullable();
            $table->string('after')->nullable();
            $table->unsignedInteger('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tss_logs');
    }
};
