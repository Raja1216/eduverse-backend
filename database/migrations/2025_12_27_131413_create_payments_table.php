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
           $table->foreignId('order_id')->constrained()->cascadeOnDelete();
           $table->string('payment_gateway')->default('payu');
           $table->string('transaction_id')->nullable();
           $table->decimal('amount', 10, 2);
           $table->enum('status', [
               'initiated',
               'success',
               'failed',
               'cancelled'
           ])->default('initiated');
           $table->json('gateway_response')->nullable();
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
