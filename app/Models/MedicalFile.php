<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MedicalFile extends Model
{
    protected $fillable = [
    'patient_id', 'doctor_id', 'category_id', 'original_name', 
    'stored_name', 'file_path', 'file_size', 'mime_type', 
    'file_extension', 'title', 'description', 'study_date', 
    'notes', 'version', 'parent_file_id', 'is_encrypted', 
    'encryption_key', 'is_active'
];


#se define la funcion de la relacion
    public function patient()
    {
    #se define la relacion entre tablas 
        return $this->belongsTo(User::class,'patient_id'); 
    }


    public function doctor()
    {
        return $this->belongsTo(User::class,'doctor_id');
    }

    public function category()
    {
        return $this->belongsTo(MedicalFileCategory::class,'category_id');
    }
}
