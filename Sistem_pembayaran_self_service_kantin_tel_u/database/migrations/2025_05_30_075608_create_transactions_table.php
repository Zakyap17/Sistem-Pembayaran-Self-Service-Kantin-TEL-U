<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->foreignId('order_id')->constrained('orders', 'order_id');
            $table->foreignId('user_id')->constrained('users', 'user_id');
            $table->enum('payment_method', ['cash', 'e-wallet', 'bank_transfer']);
            $table->enum('status', ['pending', 'success', 'failed']);
            $table->decimal('amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
