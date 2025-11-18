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
    Schema::create('discount_rules', function (Blueprint $table) {
    $table->id();
    $table->foreignId('discount_id')->constrained()->onDelete('cascade');
    $table->string('region')->nullable();
    $table->string('weight_range')->nullable();
    $table->decimal('discounted_rate', 10, 2)->nullable();
    $table->decimal('return_charge', 5, 2)->nullable();
    $table->decimal('cod', 5, 2)->nullable();
    $table->decimal('additional_charge', 10, 2)->nullable();
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount_rules');
    }
};
