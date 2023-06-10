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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            // $table->unsignedInteger('customer_id');
            // $table->foreign('customer_id')->references('id')->on('customers');
            $table->unsignedInteger('request_id');
            $table->foreign('request_id')->references('id')->on('requests');
            $table->string('event_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
