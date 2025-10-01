<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MedicalFileController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
#rutas de archivos medicos 
Route::get('/medical-files/create', [MedicalFileController::class, 'create'])->name('medical-files.create');
Route::post('/medical-files', [MedicalFileController::class, 'store'])->name('medical-files.store');
Route::get('/medical-files', [MedicalFileController::class, 'index'])->name('medical-files.index');


#Rutas de facturas 

Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoices.index');
Route::get('/invoices/create', [InvoiceController::class, 'create'])->name('invoices.create');
Route::post('/invoices', [InvoiceController::class, 'store'])->name('invoices.store');
Route::get('/invoices/{invoice}', [InvoiceController::class, 'show'])->name('invoices.show');


#Rutas de metodos de pago
#Route::get('/payments/create', [PaymentController::class, 'create'])->name('payments.create');
#Route::post('/payments', [PaymentController::class, 'store'])->name('payments.store');


#rutas para creacion de usuarios 


Route::apiResource('users', UserController::class);
Route::get('users/role/{role}', [UserController::class, 'getByRole']); // Si quieres filtrar por rol
















