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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('invoice_id')->nullable()->constrained('invoices')->onDelete('set null');
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            $table->string('transaction_id',100)->unique();
            $table->string('external_id',100)->nullable();
            $table->decimal('amount',12,2);
            $table->decimal('fee',10,2)->default(0.00);
            $table->decimal('net_amount',12,2);
            $table->string('currency',3)->default('MXN');
            $table->enum('status',['pendiente','completada','fallida','cancelada','reembolsada'])->default('pendiente');
            $table->string('gateway_status',50)->nullable();
            $table->string('authorization_code',50)->nullable();
            $table->timestamp('processed_at')->nullable();

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
