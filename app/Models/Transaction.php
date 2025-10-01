<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{


    protected $fillable = [
    'invoice_id',
    'patient_id',
    'payment_method_id', 
    'transaction_id',
    'external_id',
    'amount',
    'fee',
    'net_amount',
    'currency',
    'status',
    'gateway_status',
    'description',
    'reference',
    'authorization_code',
    'gateway_response',
    'failure_reason',
    'processed_at'
    ];



    public function invoice ()
    {
        return $this->belongsTo(Invoice::class,'invoice_id');
    }


    public function patient ()
    {
        return $this->belongsTo(User::class,'patient_id');
    }


    public function paymentMethod ()
    {
        return $this->belongsTo(PaymentMethod::class,'payment_method_id');
    }

}
