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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->date('invoice_Date');
            $table->date('Due_date');
            $table->string('product');
            $table->unsignedBigInteger('section_id');
            $table->decimal('Amount_collection', 10, 2);
            $table->decimal('Amount_Commission', 10, 2);
            $table->decimal('Discount', 10, 2);
            $table->decimal('Value_VAT', 10, 2);
            $table->decimal('Rate_VAT', 5, 2);
            $table->decimal('Total', 10, 2);
            $table->string('Status');
            $table->integer('Value_Status');
            $table->text('note')->nullable();
            $table->date('Payment_Date')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};