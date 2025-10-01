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
        Schema::create('medical_file_categories', function (Blueprint $table) {
        
       #Definimos campos 

            $table->id();
            $table->string('name',100)->unique();#unico valor,(no se puede repetir)
            $table->text('description')->nullable();
            $table->string('icon',50)->nullable();
            $table->string('color',7)->default('#6B7280');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_file_categories');
    }
};
