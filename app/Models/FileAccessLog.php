<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileAccessLog extends Model
{

    protected $fillable = [
    'medical_file_id',
    'user_id', 
    'action',
    'ip_address',
    'user_agent',
    'details'
    ];






    public function medicalFile(){
        return $this->belongsTo(MedicalFile::class,'medical_file_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
