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
        Schema::create('medical_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->unique()->onDelete('cascade');#si se borra el usuario, se borra el perfil medico }
            $table->string('medical_license',50);
            $table->string('specialty',100);
            $table->string('clinic_name',255)->nullable();
            $table->text('clinic_address')->nullable();
            $table->decimal('consultation_fee',10,2)->default(0.00);
            





            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_profiles');
    }
};
