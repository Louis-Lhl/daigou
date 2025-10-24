<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('orders', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained();
            $t->string('order_no')->unique();
            $t->string('status')->default('PENDING_PAYMENT'); // ...CONFIRMED/SHIPPED/COMPLETED/CANCELLED
            $t->unsignedInteger('subtotal_twd');
            $t->unsignedInteger('shipping_fee_twd')->default(0);
            $t->unsignedInteger('total_twd');
            $t->string('payment_method'); // CASH / BANK_TRANSFER
            $t->string('payment_proof_path')->nullable(); // 存储到 storage/app/public/...
            $t->timestamp('payment_verified_at')->nullable();
            $t->string('receiver_name');
            $t->string('receiver_phone');
            $t->string('receiver_address');
            $t->timestamp('placed_at')->nullable();
            $t->timestamps();
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
