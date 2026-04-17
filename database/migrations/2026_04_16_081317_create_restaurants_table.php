<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Enums\RestaurantStatus;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('restaurants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('owner_id')->constrained('users')->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();
            $table->time('opening_time');
            $table->time('closing_time');
            $table->string('address');
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->double('rating')->default(0);
            $table->integer('rating_count')->default(0);
            $table->integer('commission_percentage')->default(0);
            $table->string('status')->default(RestaurantStatus::ACTIVE->value);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
