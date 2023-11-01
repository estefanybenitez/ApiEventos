<?php

namespace App\Http\Controllers;
use App\Models\CategoriaEventos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriaEventosController extends Controller
{
    //
    public function selectCategoria(){
        $categoria = CategoriaEventos:: all();

        if ($categoria->count()>0) {

            return response()->json([
                'code'=> 200,
                'data'=> $categoria
            ],200);
        }
        else{
            return response()->json([
                'code'=> 404,
                'data'=> 'No hay registros'
            ],404);
        }
        
    }

    public function storeCategoria(Request $request){

        $validacion = Validator::make($request->all(),[
            'nombre_categoria'
        ]);

        if ($validacion->fails()) {
            return response() -> json([
                'code'=>400,
                'data'=> $validacion->messages()
            ],400);
        }
        else{
            $categoria = CategoriaEventos::create($request->all());
            return response ()->json([
                'code'=>200,
                'data'=>'Registro Exitoso!'
            ],200);
        }
    }

    public function updateCategoria(Request $request, $id){

        $validacion = Validator::make($request->all(),[
            'nombre_categoria'
        ]);

        if ($validacion->fails()) {
            return response() -> json([
                'code'=>400,
                'data'=> $validacion->messages()
            ],400);
        }
        else{
            $categoria = CategoriaEventos::find($id);
            if ($categoria) {
                $categoria ->update([
                    'nombre_categoria' => $request -> nombre_categoria
                ]);
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

    public function findCategoria($id){

        $categoria = CategoriaEventos::find($id);
        if ($categoria) {
                
            return response()->json([
            'code' =>200,
            'data'=> $categoria
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

    public function deleteCategoria($id){

        $categoria = CategoriaEventos::find($id);

        if ($categoria) {
            
            $categoria ->delete();

            return response()->json([
                'code' =>200,
                'data'=>  'Registro Eliminado!'
        ], 200);

        }
        else{
                //se retorna la respuesta
                return response() ->json([
                    'code'=>404,
                    'data'=>'Registro no existe'
                ],404);

            }
    }
}
