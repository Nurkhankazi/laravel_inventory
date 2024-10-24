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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('sales_id')->nullable();
            $table->integer('purchase_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->decimal('amount');
            $table->date('pay_date');
            $table->string('pay_type')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('check_number')->nullable();
            $table->string('check_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
