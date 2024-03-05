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
        Schema::create('tss_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number', 20); // Request Number ,,, Training Number  ======== ym-(user_id)-000000(id)
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('category', 20); // PU / RU / PM
            $table->string('unit_type');
            $table->string('brand', 20);
            $table->string('model', 30);
            $table->string('no_of_unit', 5)->nullable();
            $table->string('billing_type', 20)->nullable(); // Chargeable / Non-Chargeable
            $table->string('type', 10); // URGENT / PLANNED

            // if category is PM 
            $table->boolean('is_PM');
            $table->string('contract_details', 100)->nullable();

            // Additional Information
            $table->string('no_of_attendees', 5)->nullable();
            $table->string('venue')->nullable(); 
            $table->string('plan_start_date', 15)->nullable();
            $table->string('plan_end_date', 15)->nullable();
            $table->string('training_date', 15)->nullable();
            $table->string('end_date', 15)->nullable();
            $table->string('knowledge_of_participants', 20)->nullable();
            $table->string('trainer', 3)->nullable();
            $table->text('remarks')->nullable();

            $table->boolean('is_approved')->default(0);
            $table->boolean('is_deleted')->default(0);
            $table->string('status', 20)->default('PENDING');

            $table->string('key', 50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tss_requests');
    }
};
