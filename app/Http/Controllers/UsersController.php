<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class UsersController extends Controller
{
    //
    public function verificarRegistro(){
        $usuarioRegistrado = true;
        return response()->json(['registrado'=> $usuarioRegistrado]);
    }
    
    public function selectUser(){

        $user = User:: all();
        if ($user ->count() > 0 ) {

            return response()->json([
                'code'=> 200,
                'data'=> $user
            ],200);

        }else{
            return response()->json([
                'code'=> 404,
                'data'=> 'no hay registros'
            ],404);
        }

    }
    public function storeUser(Request $request){
        
        $validacion = Validator::make($request->all(),[
            'email'=> 'required',
            'password'=> 'required',
            'id_rol'=> 'required',
        ]);
        if ($validacion->fails() ) {

            return response() ->json([
                'code'=> 400,
                'data'=> $validacion ->messages()
            ], 400);
        }else{
            $user = User::create($request -> all() );

            return response() ->json([
                'code'=>200,
                'data'=>'insertado'
            ],200);
        }
        
    }
    public function updateUser(Request $request, $id){

        $validacion = Validator::make($request->all(),[
            'email'=> 'required',
            'password'=> 'required',
            'id_rol'=> 'required',
        ]);
        if ($validacion->fails() ){
            return response() ->json([
                'code'=> 400,
                'data'=> $validacion ->messages()
            ], 400);
        } else{
            $user = User::find($id);

            if ($user) {
                $user -> update([
                    'email'=> $request -> email,
                    'password'=> $request ->password,
                    'id_rol'=>$request -> id_rol,

                ]);
                return response() ->json([
                    'code'=>200,
                    'data'=>'User actualizado'
                ],200);
            } else {
                return response() ->json([
                    'code'=> 404,
                    'data'=>'no encontrado'
                ],404);

            }
        }

        
    }
    
    public function findUser($id){
        
        $user = User::find($id);
        
        if ($user) {
            return response()->json([
                'code' =>200,
                'data'=> $user
            ], 200);
        } else{
            return response()->json([
                'code'=>404,
                'data'=>'no encontrado'
            ],404);
        }
    }

    public function deleteUser($id){

        $user = User::find($id);
        
        if ($user) {
            
            $user->delete();

            return response()->json([
                'code' =>200,
                'data'=> 'ha sido eliminado'
            ], 200);
        } else{
            return response()->json([
                'code'=>404,
                'data'=>'no hay registros'
            ],404);
        }
    }

}
