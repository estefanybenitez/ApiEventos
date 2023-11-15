<?php

namespace App\Http\Controllers;

use App\Models\Asistentes;
use App\Models\Eventos;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EventosController extends Controller
{
    //
    public function selectEventos(){

        try{

            $evento = Eventos::select(
                'eventos.id',
                'eventos.titulo', 
                'eventos.descripcion',
                'eventos.fecha',
                'eventos.hora',
                'eventos.ubicacion',
                'eventos.imagen',

                'categoria.nombre_categoria as fk_categoria'
                )->join('categoria',
                'eventos.fk_categoria', '=' , 'categoria.id')
                ->get();

            if($evento ->count()>0){

                return response()->json([
                    'code' => 200,
                    'data' => $evento
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

    public function storeEventos(Request $request){
        try{
            $validacion = Validator::make($request ->all(),[
                'titulo'=>'required',
                'descripcion'=>'required',
                'fecha'=>'required',
                'hora'=>'required',
                'ubicacion'=>'required',
                'imagen'=>'required',
                'fk_categoria'=>'required',
            ]);
            if ($validacion-> fails()) {
                return response()->json([
                    'code'=>400,
                    'data'=> $validacion->messages()
                ], 400);

            }
            else{
            
                $evento = Eventos::create($request->all());

                return response()->json([
                    'code'=>200,
                    'data'=> 'Registro ingresado'
                ], 200);

            }


        }
        catch(\Throwable $th){
            return response()->json
            ($th->getMessage(), 500);
        }
    }

    public function updateEventos(Request $request, $id){
        try{
            $validacion = Validator::make($request ->all(),[
                'titulo'=>'required',
                'descripcion'=>'required',
                'fecha'=>'required',
                'hora'=>'required',
                'ubicacion'=>'required',
                'imagen'=>'required',
                'fk_categoria'=>'required',
            ]);
            if ($validacion-> fails()) {
                return response()->json([
                    'code'=>400,
                    'data'=> $validacion->messages()
                ], 400);

            }
            else{
                $evento = Eventos::find($id);

                if ($evento) {
                    $evento->update($request->all());
                    return response()->json([
                        'code' => 200,
                        'data'=>'Registro Actualizado'
                    ],200);
                }
                else{
                    return response()->json([
                        'code'=>404,
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
    public function findLista($id){

        try{
                $evento = Eventos::find($id);
                if ($evento) {

                    $datos = Asistentes::select(
                        'asistentes.id',
                        'asistentes.nombre',
                        'asistentes.apellido',
                        'asistentes.fk_evento',
                        )
                        ->join('eventos', 'asistentes.fk_evento', '=', 'eventos.id')
                        ->where('eventos.id', '=', $id)
                        ->get();
                        return response()->json([
                            'code' => 200,
                            'data' => $datos
                            ], 200);
                    }
                            
                
                else{
                    return response()->json([
                        'code'=>404,
                        'data'=> 'Registro no encontrado '
                    ], 404);
                }

         
        }
        catch (\Throwable $th) {
            //throw $th;
            return response()->json
            ($th->getMessage(), 500);
        }
        
    }
    // para mostrar los eventos del lado del asistente
    public function findEventosAsistentes($id){

        try{
            $evento = Eventos::find($id);
            if($evento){
                $datos = Eventos::select(
                    'eventos.id',
                    'eventos.titulo', 
                    'eventos.descripcion',
                    'eventos.fecha',
                    'eventos.hora',
                    'eventos.ubicacion',
                    'eventos.imagen',
                    'eventos.fk_categoria',
                    'categoria.nombre_categoria as categoria'
                )->join('categoria',
                'eventos.fk_categoria', '=' , 'categoria.id')
                ->where('eventos.id', '=', $id)
                ->get();

                return response()->json([
                    'code' => 200,
                    'data' => $datos
                    ], 200);
            }else{
                return response()->json([
                    'code'=>404,
                    'data'=> 'Registro no encontrado '
                ], 404);
            }
        }
        catch (\Throwable $th) {
            //throw $th;
            return response()->json
            ($th->getMessage(), 500);
        }
        
    }
    // para mostrar los eventos del lado del organizador
    public function findEventos($id){

        try{
            $evento = Eventos::find($id);
            if($evento){
                $datos = Eventos::select(
                    'eventos.id',
                    'eventos.titulo', 
                    'eventos.descripcion',
                    'eventos.fecha',
                    'eventos.hora',
                    'eventos.ubicacion',
                    'eventos.imagen',
                    'eventos.fk_categoria',
                    'categoria.nombre_categoria as categoria'
                )->join('categoria',
                'eventos.fk_categoria', '=' , 'categoria.id')
                ->where('eventos.id', '=', $id)
                ->get();

                return response()->json([
                    'code' => 200,
                    'data' => $datos[0]
                    ], 200);
            }else{
                return response()->json([
                    'code'=>404,
                    'data'=> 'Registro no encontrado '
                ], 404);
            }
        }
        catch (\Throwable $th) {
            //throw $th;
            return response()->json
            ($th->getMessage(), 500);
        }
        
    }



    public function deleteEventos($id){
        try{
            $evento = Eventos::find($id);

            if ($evento) {
                $evento ->delete($id);
                return response()->json([
                    'code' =>200,
                    'data' =>'Registro Eliminado'
                ], 200); 
            }
            else{
                return response()->json([
                    'code'=>404,
                    'data'=> 'Registro no existe'
                ], 404);
            }

        }
        catch (\Throwable $th) {
            return response()->json
        ($th->getMessage(), 500);
    }
    }
}
