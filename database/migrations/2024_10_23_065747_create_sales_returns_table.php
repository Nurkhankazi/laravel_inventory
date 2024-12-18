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
        Schema::create('sales_returns', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->string('salesreturn_date');
            $table->decimal('total',10,2);
            $table->decimal('discount',10,2);
            $table->decimal('tax',10,2);
            $table->decimal('gtotal',10,2);
            $table->decimal('discountamt',10,2);
            $table->decimal('taxamt',10,2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_returns');
    }
};
