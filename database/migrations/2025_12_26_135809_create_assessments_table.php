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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->string('title');               // EAST Level 1, Level 2
            $table->text('description');
            $table->string('class');               // 3-5, 6-9, 10-12
            $table->decimal('price', 10, 2)->default(499);
            $table->string('image')->nullable();
            $table->json('features')->nullable();  // evaluation, report, certificate
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
