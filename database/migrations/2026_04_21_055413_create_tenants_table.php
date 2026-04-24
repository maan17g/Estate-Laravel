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
        Schema::create('tenants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('property_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('lease_start_date');
            $table->date('lease_end_date');
            $table->decimal('deposit_paid_amount', 12, 2)->nullable();
            $table->date('rent_paid_until')->nullable();
            $table->enum('status', ['active', 'expired', 'terminated'])->default('active');
            $table->enum('reference_check_status', ['pending', 'passed', 'failed'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenants');
    }
};
