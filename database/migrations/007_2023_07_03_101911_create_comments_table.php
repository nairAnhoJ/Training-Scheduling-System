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
        Schema::create('tss_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('req_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('commenter_id');
            $table->binary('content');
            $table->string('is_read');
            $table->string('key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tss_comments');
    }
};
