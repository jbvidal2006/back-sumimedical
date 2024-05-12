<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $response = User::create($inputs);
        return response()->json([
            'data'=>$response,
            'message'=>'Usuario creado con éxito'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find($id);
        if(isset($user)){
            return response()->json([
                'data'=>$user,
                'message'=>'Usuario encontrado con éxito'
            ]);
        }else{
            return response()->json([
                'data'=>[],
                'message'=>'El usuario no existe'
            ]);
        }   
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        if(isset($user)){
            $user->name = $request->name;
            $user->description = $request->description;
            $user->status = $request->status;
            $user->priority = $request->priority;
            if($user->save()){
                return response()->json([
                    'data'=>$user,
                    'message'=>'Usuario actualizado con éxito'
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'message'=>'No existe el Usuario'
                ]); 
            }
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'No existe el usuario'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if(isset($user)){
            $res = User::destroy($id);
            if($res){
                return response()->json([
                    'data'=>[],
                    'message'=>'Usuario eliminado con éxito'
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'message'=>'Error al eliminar el usuario'
                ]); 
            } 
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'No existe el usuario'
            ]);
        }
    }
    
}
