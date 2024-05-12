<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $inputs = $request->input();
        $response = Task::create($inputs);
        return response()->json([
            'data'=>$response,
            'message'=>'Tarea creada con éxito'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::find($id);
        if(isset($task)){
            return response()->json([
                'data'=>$task,
                'message'=>'Tarea encontrada con éxito'
            ]);
        }else{
            return response()->json([
                'data'=>[],
                'message'=>'La tarea no existe'
            ]);
        }   
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $task = Task::find($id);
        if(isset($task)){
            $task->name = $request->name;
            $task->description = $request->description;
            $task->status = $request->status;
            $task->priority = $request->priority;
            if($task->save()){
                return response()->json([
                    'data'=>$task,
                    'message'=>'Tarea actualizada con éxito'
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'message'=>'No existe la tarea '
                ]); 
            }
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'No existe la tarea '
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task = Task::find($id);
        if(isset($task)){
            $res = Task::destroy($id);
            if($res){
                return response()->json([
                    'data'=>[],
                    'message'=>'Tarea eliminada con éxito'
                ]);
            }else{
                return response()->json([
                    'error'=>true,
                    'message'=>'Error al eliminar la tarea'
                ]); 
            } 
        }else{
            return response()->json([
                'error'=>true,
                'message'=>'No existe la tarea '
            ]);
        }
    }
}
