<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{

    public function index() {
        #lista de facturas 
        $facturas=Invoice::with(['patient','doctor'])->orderBy('created_at','desc')->get();

        return view('invoices.index',compact('facturas'));


    }



    public function store(Request $request){

        $validated=$request->validate([
            'patient_id' => 'required|exists:users,id',
            'doctor_id' => 'nullable|exists:users,id',
    
            // Datos del RECEPTOR (paciente)
            'receiver_name' => 'required|string|max:255',
            'receiver_rfc' => 'nullable|string|max:13',
            'receiver_email' => 'required|email',
            'receiver_address' => 'nullable|string',
    
            // Datos del EMISOR (clínica/médico) - NUEVOS
            'issuer_name' => 'required|string|max:255',
            'issuer_rfc' => 'required|string|max:13',
            'issuer_address' => 'required|string',
    
            // Información de la factura
            'concept' => 'required|string',
            'issue_date' => 'required|date',
            'due_date' => 'required|date',
            'payment_method' => 'nullable|string|max:50',
            'payment_terms' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
    
           



        ]);


    }


    public function create(){
        
        return view('invoices.create');
    }




}
