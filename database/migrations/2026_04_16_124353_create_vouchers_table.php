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
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('restaurant_id')->nullable()->constrained('restaurants')->onDelete('cascade');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->text('data')->nullable();
            $table->integer('discount_percentage')->nullable();
            $table->integer('minimum_order_amount')->nullable();
            $table->integer('maximum_discount_amount')->nullable();
            $table->dateTime('valid_from')->nullable();
            $table->dateTime('valid_until')->nullable();
            $table->integer('usage_limit')->nullable();
            $table->integer('used_count')->default(0);
            $table->boolean('is_unlimited')->default(false);
            $table->boolean('is_global')->default(false);
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vouchers');
    }
};
