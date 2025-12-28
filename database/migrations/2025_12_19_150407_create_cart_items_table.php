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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            $table->enum('item_type', [
                'program',
                'publication',
                'event',
                'assessment',
                'product'
            ]);

            $table->unsignedBigInteger('item_id');

            $table->integer('quantity')->default(1);

            // For programs
            $table->enum('payment_option', ['full', 'installment'])->nullable();
            $table->decimal('payable_amount', 10, 2); // actual amount added to cart

            // For products
            $table->string('selected_color')->nullable();
            $table->string('selected_size')->nullable();

            $table->timestamps();

            $table->unique(['user_id', 'item_type', 'item_id'], 'unique_cart_item');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
