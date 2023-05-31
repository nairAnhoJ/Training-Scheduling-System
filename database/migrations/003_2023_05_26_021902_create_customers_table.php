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
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('address')->nullable();
            $table->string('area')->nullable();

            $table->string('cp1_name')->nullable();
            $table->string('cp1_number')->nullable();
            $table->string('cp1_email')->nullable();

            $table->string('cp2_name')->nullable();
            $table->string('cp2_number')->nullable();
            $table->string('cp2_email')->nullable();

            $table->string('cp3_name')->nullable();
            $table->string('cp3_number')->nullable();
            $table->string('cp3_email')->nullable();

            // if billing_type is Chargeable 
            // $table->string('sap_entry_form')->nullable();
            // $table->string('bir_2303')->nullable();
            // $table->string('peza_erd_form')->nullable();
            // $table->string('sec_certificate')->nullable();
            // $table->string('certificate_of_incorporation')->nullable();
            // $table->string('sworn_affidavit')->nullable();
            // $table->string('tax_exemption_certificate')->nullable();
            // $table->string('vat_agreement')->nullable();

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
        Schema::dropIfExists('customers');
    }
};
