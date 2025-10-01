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
        Schema::create('medical_files', function (Blueprint $table) {
        #definicion de llaves y relacion de las mismas 
            
            $table->id();
            $table->foreignId('patient_id')->constrained('users')->onDelete('cascade');#aquí se crea una ID para relacionarla foreing key y se elimina el usuario si se borran sus archivos 
            $table->foreignId('doctor_id')->nullable()->constrained('users')->onDelete('set null');#se borra el medico, el campo se pone null
            $table->foreignId('category_id')->constrained('medical_file_categories');
        
        
        #definicion de campos 
            
            $table->string('original_name',255);
            $table->string('stored_name',255);
            $table->string('file_path',500);
            $table->bigInteger('file_size');
            $table->string('mime_type',100);
            $table->string('file_extension',10); 
            $table->string('title',255);
            $table->text('description')->nullable();
            $table->date('study_date')->nullable();
            $table->text('note')->nullable();
            $table->integer('version')->default(1);
            $table->foreignId('parent_file_id')->nullable()->constrained('medical_files')->onDelete('set null');
            $table->boolean('is_encrypted')->default(true);
            $table->string('encryption_key',255)->nullable();
            $table->boolean('is_active')->default(true);
        
        
        #timestamps() es un atajo que crea los dos campos de timestamp
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_files');
    }
};
