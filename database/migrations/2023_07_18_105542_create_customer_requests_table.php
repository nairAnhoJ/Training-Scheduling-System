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
        Schema::create('tss_customer_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address');

            $table->string('cp1_name');
            $table->string('cp1_number');
            $table->string('cp1_email');

            $table->string('cp2_name');
            $table->string('cp2_number');
            $table->string('cp2_email');

            $table->string('cp3_name');
            $table->string('cp3_number');
            $table->string('cp3_email');

            $table->string('category');
            $table->string('brand');
            $table->string('model');
            $table->string('unit_type');
            $table->string('no_of_unit');
            $table->string('no_of_attendees');
            $table->string('knowledge_of_participants');

            $table->string('is_decline')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tss_customer_requests');
    }
};
