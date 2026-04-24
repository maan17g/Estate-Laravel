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
        Schema::create('rental_payment_schedule', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->date('due_date');
            $table->decimal('amount', 12, 2);
            $table->enum('status', ['pending', 'paid', 'overdue'])->default('pending');
            $table->date('payment_date')->nullable();
            $table->string('payment_method', 50)->nullable();
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental_payment_schedule');
    }
};
