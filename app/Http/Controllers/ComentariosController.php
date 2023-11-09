<?php

namespace App\Http\Controllers;
use App\Models\Comentarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComentariosController extends Controller
{
    //
    public function selectComentarios(){

        try{
            $comentario = Comentarios::select(
                'comentarios.id',
                'comentarios.comentario',
                'comentarios.id_asistente',
                'asistentes.nombre as nameasistente',
                'asistentes.correo as emailasistente',
                'comentarios.id_evento',
                'eventos.titulo as titulo',
            )->join('asistentes', 'comentarios.id_asistente', '=', 'asistentes.id')
            ->join('eventos', 'comentarios.id_evento', '=', 'eventos.id')
            ->get();

            if ($comentario ->count()>0 ) {

                    return response()-> json ([
                        'code'=> 200,
                        'data'=> $comentario
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

    public function storeComentarios(Request $request){
        try{
            $validacion = Validator:: make($request->all(),[
                'comentario' => 'required',
                'id_asistente' => 'required',
                'id_evento' => 'required',
            ]);

            if ($validacion->fails()) {
                return response() -> json([
                    'code'=>400,
                    'data'=> $validacion->messages()
                ],400);
            }
            else{
                $comentario = Comentarios::create($request->all());
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

    public function updateComentarios(Request $request, $id){
        try{
            $validacion = Validator:: make($request->all(),[
                'comentario' => 'required',
                'id_asistente' => 'required',
                'id_evento' => 'required',
            ]);
    
            if ($validacion->fails()) {
                return response() -> json([
                    'code'=>400,
                    'data'=> $validacion->messages()
                ],400);
            }
            else{
                $comentario = Comentarios::find($id);
                if ($comentario) {
                    //si existe se actualiza
                    $comentario ->update($request->all());
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

    public function findComentarios($id ){
        try{

            $comentario = Comentarios::find($id);
                if ($comentario) {
                    $datos = Comentarios::select(
                        'comentarios.id',
                        'comentarios.comentario',
                        'comentarios.id_asistente',
                        'asistentes.nombre as nameasistente',
                        'asistentes.correo as emailasistente',
                        'comentarios.id_evento',
                        'eventos.titulo as titulo',
                    )->join('asistentes', 'comentarios.id_asistente', '=', 'asistentes.id')
                    ->join('eventos', 'comentarios.id_evento', '=', 'eventos.id')
                    ->where('comentarios.id', '=', $id)
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

    public function deleteComentarios($id){
        try{

            $comentario= Comentarios::find($id);
            if ($comentario){
    
                $comentario ->delete($id);
    
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
