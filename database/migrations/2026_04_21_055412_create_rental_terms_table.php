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
        Schema::create('rental_terms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->tinyInteger('min_lease_months')->nullable();
            $table->tinyInteger('max_lease_months')->nullable();
            $table->decimal('deposit_amount', 12, 2)->nullable();
            $table->enum('deposit_type', ['fixed', 'percentage'])->nullable();
            $table->boolean('pet_friendly')->default(false);
            $table->boolean('smoking_allowed')->default(false);
            $table->boolean('utilities_included')->default(false);
            $table->text('cancellation_terms')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_terms');
    }
};
