<?php

namespace App\Http\Controllers;
use App\Models\Asistentes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AsistentesController extends Controller
{
    //
    public function selectAsistentes(){

        try{
            $asistente = Asistentes::select(
                'asistentes.id',
                'asistentes.nombre',
                'asistentes.apellido',
                'asistentes.correo',
                'asistentes.fk_evento',
                'eventos.titulo as titulo_evento'
            )->join('eventos', 'asistentes.fk_evento', '=', 'eventos.id')
            ->get();

            if ($asistente ->count()>0 ) {

                    return response()-> json ([
                        'code'=> 200,
                        'data'=> $asistente
                    ],200);
                }  
                else{
                    return response()->json([
                        'code'=> 404,
                        'data'=> 'No hay registros'
                    ],404);
                }

        }
        catch(\Throwable $th)
        {
            return response()->json
            ($th->getMessage(), 500);
        }

     
    }

    public function storeAsistentes(Request $request){
        try{
            $validacion = Validator:: make($request->all(),[
                'nombre' => 'required',
                'apellido' => 'required',
                'correo' => 'required',
                'fk_evento' => 'required',
            ]);

            if ($validacion->fails()) {
                return response() -> json([
                    'code'=>400,
                    'data'=> $validacion->messages()
                ],400);
            }
            else{
                $asistentes = Asistentes::create($request->all());
                return response ()->json([
                    'code'=>200,
                    'data'=>'Registro Exitoso!'
                ],200);
            }

        }
        catch(\Throwable $th){
            return response()->json
            ($th->getMessage(), 500);
        }

    }

    public function updateAsistentes(Request $request, $id){
        try{
            $validacion = Validator:: make($request->all(),[
                'nombre' => 'required',
                'apellido' => 'required',
                'correo' => 'required',
                'fk_evento' => 'required',
            ]);
    
            if ($validacion->fails()) {
                return response() -> json([
                    'code'=>400,
                    'data'=> $validacion->messages()
                ],400);
            }
            else{
                $asistente = Asistentes::find($id);
                if ($asistente) {
                    //si existe se actualiza
                    $asistente ->update($request->all());
                    //retorna respuesta
                    return response() ->json([
                        'code'=>200,
                        'data'=>'Registro actualizado!'
                    ],200);
                }
                else{
                    return response() ->json([
                        'code'=> 404,
                        'data'=>'Registro no encontrado'
                    ],404);
                }
            }

        }
        catch(\Throwable $th){
            return response()->json
            ($th->getMessage(), 500);
        }
        
    }

    public function findAsistentes($id ){
        try{

            $asistente = Asistentes::find($id);
                if ($asistente) {
                    $datos = Asistentes::select(
                        'asistentes.id',
                        'asistentes.nombre',
                        'asistentes.apellido',
                        'asistentes.correo',
                        'asistentes.fk_evento',
                        'eventos.titulo as titulo_evento'
                    )->join('eventos', 'asistentes.fk_evento', '=', 'eventos.id')
                    ->where('asistentes.id', '=', $id)
                    ->get();


                    return response()->json([
                    'code' =>200,
                    'data'=> $datos[0]
                ], 200);
    
            }
            else{
                    //se retorna la respuesta
                    return response() ->json([
                        'code'=>404,
                        'data'=>'Registro no encontrado'
                    ],404);
    
                }
        }
        catch(\Throwable $th){
            return response()->json
            ($th->getMessage(), 500);
        }
    }

    public function deleteAsistentes($id){
        try{

            $asistente= Asistentes::find($id);
            if ($asistente){
    
                $asistente ->delete($id);
    
                return response()->json([
                    'code' =>200,
                    'data'=> 'Registro Eliminado!'
                ],200);
            } 
            else{
                return response()->json([
                    'code'=> 404,
                    'data'=>'El registro no existe'
                ],404);
            }
        }
        catch (\Throwable $th) {
            return response()->json
        ($th->getMessage(), 500);
    }
    }


}
