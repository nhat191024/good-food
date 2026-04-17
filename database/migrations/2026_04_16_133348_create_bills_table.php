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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('restaurant_id')->constrained('restaurants')->onDelete('cascade');
            $table->foreignId('shipper_id')->constrained('users')->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('voucher_code')->nullable();
            $table->foreignId('location_id')->constrained('locations')->onDelete('cascade');
            $table->string('address');
            $table->integer('total');
            $table->integer('total_final');
            $table->integer('discount')->nullable();
            $table->text('note')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
