<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',                  
        'phone',                   
        'date_of_birth',           
        'rfc',                     
        'business_name',           
        'fiscal_address',          
        'is_active' 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',

    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'date_of_birth' => 'date',      // Convierte string a objeto Carbon
            'is_active' => 'boolean',       // Convierte a true/false
            'consultation_fee' => 'decimal:2'
        ];
    }

    /**
     * Get the user's initials
     */
    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->take(2)
            ->map(fn ($word) => Str::substr($word, 0, 1))
            ->implode('');
    }

    #Relación con archivos médicos (como paciente)
    public function medicalFiles()
    {
        return $this->hasMany(MedicalFile::class,'patient_id');
    }

    # Relación con perfil médico (si es médico)
    public function medicalProfile()
    {
        return $this->hasOne(MedicalProfile::class,'user_id');
    }


    public function invoices()
    {
        return $this->hasMany(Invoice::class,'patient_id');
    }


    public function transactions()
    {
        return $this->hasMany(Transaction::class,'patient_id');
    }




}
