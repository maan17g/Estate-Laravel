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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('description')->nullable();
            $table->foreignId('agent_id')->constrained()->onDelete('cascade');
            $table->foreignId('property_type_id')->constrained();
            $table->enum('transaction_type', ['sale', 'rent']);
            $table->foreignId('status_id')->constrained('property_statuses');
            $table->decimal('sale_price', 15, 2)->nullable();
            $table->decimal('rental_price', 12, 2)->nullable();
            $table->enum('rental_period', ['monthly', 'yearly'])->nullable();
            $table->tinyInteger('bedrooms')->nullable();
            $table->tinyInteger('bathrooms')->nullable();
            $table->decimal('area_sqft', 10, 2)->nullable();
            $table->year('year_built')->nullable();
            $table->enum('furnishing_type', ['furnished', 'unfurnished', 'semi'])->nullable();
            $table->tinyInteger('parking_spaces')->default(0);
            $table->tinyInteger('floor_number')->nullable();
            $table->tinyInteger('total_floors')->nullable();
            $table->string('video_url', 500)->nullable();
            $table->string('virtual_tour_url', 500)->nullable();
            $table->boolean('featured')->default(false);
            $table->date('featured_until')->nullable();
            $table->integer('views_count')->default(0);
            $table->string('seo_title')->nullable();
            $table->text('seo_description')->nullable();
            $table->text('seo_keywords')->nullable();
            $table->boolean('published')->default(false);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
