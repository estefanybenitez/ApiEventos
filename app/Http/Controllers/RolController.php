<?php

namespace App\Http\Controllers;
use App\Models\Rol;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RolController extends Controller
{
    //
    public function selectRol(){

        $rol = rol:: all();
        if ($rol ->count() > 0 ) {

            // si hay registros retorna un json
            return response()->json([
                'code'=> 200,
                'data'=> $rol
            ],200);

        }else{
            // si no hay registros retorna un json
            return response()->json([
                'code'=> 404,
                'data'=> 'No hay registros'
            ],404);

        }

    }
    public function storeRol(Request $request){

        $validacion = Validator::make($request -> all(),[
            'nombre_rol'=> 'required',
        ]);

        if ($validacion->fails() ) {

            return response() ->json([
                'code'=> 400,
                'data'=> $validacion ->messages()
            ], 400);
        }else {
            
            $roles = Rol::create($request -> all() );
            return response() ->json([
                'code'=>200,
                'data'=>'rol insertado'
            ],200);
        }
    }
    public function updateRol(Request $request, $id)
    {
          $validacion = Validator::make($request->all(),[
            'nombre_rol' => 'required',
           
        ]);
        if ($validacion->fails() ){
            //si hay error se retorna mensaje de error
            return response() -> json([
               'code'=> 400,
               'data'=> $validacion -> messages()
            ], 400);
        }else{
            $roles = Rol::find($id);
            if ($roles) {
                //si existe actualiza
                $roles ->update([
                    'nombre_rol' => $request -> nombre_rol,
                
                ]);

                //se retorna la respuesta
                return response() ->json([
                    'code'=>200,
                    'data'=>'Registro actualizado'
                ],200);


            }else{
                return response() ->json([
                    'code'=> 404,
                    'data'=>'no encontrado'
                ],404);
            }

        }
        
    }

    public function findRol($id) {

        $roles = Rol::find($id);
            if ($roles) {
                
                return response()->json([
                'code' =>200,
                'data'=> $roles
            ], 200);
            

        }
        else{
                //se retorna la respuesta
                return response() ->json([
                    'code'=>404,
                    'data'=>'no encontrado'
                ],404);

            }


        
    }

    public function deleteRol($id){

        $roles = Rol::find($id);
        
        if ($roles) {
            // Si el estudiante existe se elimina 
            $roles->delete();

            return response()->json([
                'code' =>200,
                'data'=> 'ha sido eliminada'
            ], 200);
        } else{
            return response()->json([
                'code'=>404,
                'data'=>'no hay registros'
            ],404);
        }
    }

}
