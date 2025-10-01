<?php

namespace App\Http\Controllers;


use App\Models\MedicalFile;
use App\Models\MedicalFileCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MedicalFileController extends Controller
{
    public function create ()
    {
        $categories= MedicalFileCategory::all();

        return view('medical-files.create',['categories'=>$categories]);

    }

    public function store(Request $request)
    {
   
       
        #valida los datos 
         $request->validate([

            'patient_id'=>'required',
            'category_id'=>'required',
            'file'=>'required|file',
            'title'=>'required'


         ]);
         
         #GUARDA LOS ARCHIVOS EN EL SERVIDOR 
         
         #Toma el archivo que el usuario envió en el campo llamado 'file'
         $archivo= $request->file('file');

         #Guarda este archivo en la carpeta 'medical-files' del servidor"
         $ruta= $archivo->store('medical-files');
         

         #GUARDA LA INFORMACION EN LA BASE DE DATOS 

         MedicalFile::create([
            'patient_id'=>$request->patient_id,
            'doctor_id'=>Auth::id(),
            'category_id'=> $request->category_id,
            'original_name'=>$archivo->getClientOriginalName(),
            #hace que el nombre de los archivos no se dupliquen 
            'stored_name' => uniqid() . '_' . $archivo->getClientOriginalName(),
            'mime_type' => $archivo->getMimeType(),
            'file_extension' => $archivo->getClientOriginalExtension(),
            'file_path'=>$ruta,
            'file_size'=>$archivo->getSize(),
            'title'=>$request->title,
            'version' => 1,
            'is_encrypted' => false,
            'is_active' => true

         ]);

         return redirect()->route('medical-files.index')->with('success', '📄 Archivo médico subido exitosamente!');


    }



        public function index() 
    {
       
        #obtenemos el usuario actual 

        $usuario=Auth::user();

        // Diferente lógica según el rol
    if ($usuario->role == 'paciente') {
        // Paciente ve solo SUS archivos
        $archivos = MedicalFile::with(['category', 'doctor'])
                              ->where('patient_id', $usuario->id)
                              ->orderBy('created_at', 'desc')
                              ->get();
                              
    } elseif ($usuario->role == 'medico') {
        // Médico ve archivos de SUS pacientes
        $archivos = MedicalFile::with(['category', 'patient'])
                              ->where('doctor_id', $usuario->id)
                              ->orderBy('created_at', 'desc')
                              ->get();
                              
    } else {
        // Administrador ve TODOS los archivos
        $archivos = MedicalFile::with(['category', 'patient', 'doctor'])
                              ->orderBy('created_at', 'desc')
                              ->get();
    }
    
    return view('medical-files.index', compact('archivos'));





    }
}
