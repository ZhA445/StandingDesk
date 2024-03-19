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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->integer('phone')->nullable();
            $table->string('address')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('product_id')->nullable();
            $table->string('product_title')->nullable();
            $table->integer('price')->nullable();
            $table->string('image')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('delivary_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
