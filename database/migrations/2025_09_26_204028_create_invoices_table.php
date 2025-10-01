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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('doctor_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('folio',20)->unique();
            $table->string('series',10)->default('A');
            $table->integer('invoice_number');
            $table->string('receiver_name',255);
            $table->string('receiver_rfc',13)->nullable();
            $table->string('receiver_email',255);
            $table->text('receiver_addres',)->nullable();
            $table->string('issuer_name',255);
            $table->string('issuer_rfc',13);
            $table->text('issuer_address');
            $table->decimal('subtotal',12,2);
            $table->decimal('tax_rate',5,4)->default(0.1600);
            $table->decimal('tax_amount',12,2);
            $table->decimal('total',12,2);
            $table->text('concept');
            $table->text('notes')->nullable();
            $table->string('payment_method',50)->default('Tarjeta de credito');
            $table->string('payment_terms',100)->default('Pago inmediato');
            $table->enum('status',['pendiente','pagada','vencida','cancelada'])->default('pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
