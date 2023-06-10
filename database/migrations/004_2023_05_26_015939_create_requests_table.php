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
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->string('category'); // PU / RU / PM
            $table->string('unit_type');
            $table->string('brand');
            $table->string('model');
            $table->string('no_of_unit')->nullable();
            $table->string('billing_type')->nullable(); // Chargeable / Non-Chargeable

            // if category is PM 
            $table->string('is_PM');
            $table->string('contract_details')->nullable();

            // Additional Information
            $table->string('no_of_attendees')->nullable();
            $table->string('venue')->nullable(); 
            $table->string('training_date')->nullable();
            $table->string('knowledge_of_participants')->nullable();
            $table->string('trainer')->nullable();
            $table->string('remarks')->nullable();

            $table->string('is_approved')->default(0);
            $table->string('status')->default('PENDING');
            
            // $table->string('type_of_payment')->nullable();
            // $table->string('vat_zero_rated')->nullable();

            $table->string('key');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requests');
    }
};
