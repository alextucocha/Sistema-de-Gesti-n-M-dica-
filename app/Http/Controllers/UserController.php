<?php

namespace App\Http\Controllers;

use App\Models\MedicalProfile;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{


    public function index(Request $request){
        #Se prepara la consulta 
            $query=User::query();
        
        #filtro por rol 
            if($request->filled('role')){
                $query->where('role',$request->role);
            }
        
        #busqueda por nombre,email o rfc
        if($request->filled('search')){
            $search=$request->search;
            $query->where(function($q) use ($search) 
                {
                     $q->where('name', 'like', '%'.$search.'%')->orWhere('email', 'like', '%'.$search.'%')->orWhere('rfc', 'like', '%'.$search.'%'); 
                });
        }
        #20 registros por página 
        $users = $query->paginate(20);
        return response()->json($users);



    }



    public function store(Request $request){

        $validated = $request->validate([

            #campos obligatorios para todos los roles 
            'name'=>'required|string|max:255',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|confirmed',
            'role'=>'required|in:medico,paciente,administrador',
            'phone'=>'nullable|string|max:20',
            'date_of_birth'=>'nullable|date',
            'rfc'=>'nullable|string|max:13',
            'business_name' => 'nullable|string|max:255',
            'fiscal_address'=>'nullable|string',
            'is_active'=>'boolean',
            

            #campos solo para  Medicos 
            'medical_license'=>'required_if:role,medico|string|max:50',
            'specialty'=>'required_if:role,medico|string|max:100',
            'consultation_fee' => 'required_if:role,medico|numeric|min:0',
            #campos adicionales de medicos 
            'clinic_name'=>'nullable|string|max:255',
            'clinic_address'=>'nullable|string'
        ]);


        #añadimos los valores a las tablas 
        $user=User::create([

            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>bcrypt($validated['password']),
            'role'=>$validated['role'],
            'phone'=>$validated['phone']?? null,
            'date_of_birth'=>$validated['date_of_birth'] ?? null,
            'rfc'=>$validated['rfc'] ?? null,
            'business_name'=>$validated['business_name']?? null,
            'fiscal_address'=>$validated['fiscal_address']?? null,
            'is_active'=>$validated['is_active']?? true,

         ]);

        #validamos si es medico
        if($validated['role']==='medico'){
            
            
            MedicalProfile::create([

                'user_id'=>$user->id,
                'medical_license'=>$validated['medical_license'],
                'specialty'=>$validated['specialty'],
                'consultation_fee'=>$validated['consultation_fee'],
                'clinic_name'=>$validated['clinic_name']?? null,
                'clinic_address'=>$validated['clinic_address']?? null,
            ]);
        }

        return response()->json([
            'message'=>'Usuario creado exitosamente',
            'user'=>$user->load('medicalProfile')
        ],201);

    }


    #muestra un usuario especifico 
    public function show(User $user){

        $user->load('medicalProfile','medicalFiles','invoices','transactions');
        return response()->json($user);

    }

    #actualiza los usuarios 
    public function update(Request $request, User $user){

        $validated= $request->validate([
            #campos a actualizar 
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'rfc' => 'nullable|string|max:13',
            'business_name' => 'nullable|string|max:255',
            'fiscal_address' => 'nullable|string',
            'is_active' => 'boolean',

            #Campos específicos para médicos
            'medical_license' => 'sometimes|required_if:role,medico|string|max:50',
            'specialty' => 'sometimes|required_if:role,medico|string|max:100',
            'consultation_fee' => 'sometimes|required_if:role,medico|numeric|min:0',
            'clinic_name' => 'nullable|string|max:255',
            'clinic_address' => 'nullable|string',
            

        ]);


        #actualiza el usuario 
        $user->update($validated);
        
        #Valida si es medico, actualiza su perfil medico 
         if ($user->role === 'medico' && $user->medicalProfile) {
             $user->medicalProfile->update([
                 'medical_license' => $validated['medical_license'] ?? $user->medicalProfile->medical_license,
                 'specialty' => $validated['specialty'] ?? $user->medicalProfile->specialty,
                 'consultation_fee' => $validated['consultation_fee'] ?? $user->medicalProfile->consultation_fee,
                 'clinic_name' => $validated['clinic_name'] ?? $user->medicalProfile->clinic_name,
                 'clinic_address' => $validated['clinic_address'] ?? $user->medicalProfile->clinic_address,]);
             }
        return response()->json(['message' => 'Usuario actualizado exitosamente','user' => $user->fresh()->load('medicalProfile')]);
    }



    public function destroy(User $user){
        $user->delete();

        return response()->json(['message'=>'Usuario eliminado exitosamente']);
    }





}
