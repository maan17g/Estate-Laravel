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
        Schema::create('agents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('agency_id')->nullable()->constrained()->nullOnDelete();
            $table->string('license_number', 100)->nullable();
            $table->enum('specialization', ['residential', 'commercial', 'both'])->nullable();
            $table->text('bio')->nullable();
            $table->string('photo_path')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_sales')->default(0);
            $table->integer('total_rentals')->default(0);
            $table->enum('verification_status', ['pending', 'verified', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agents');
    }
};
