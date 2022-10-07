<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    //
    /*public function __construct()
    {
        $this->middleware('auth:api',['except'=>['login','register']]);
    }*/

    public function register(Request $request) {
        
                $message=[
                    'name.required'         =>'Veuillez Entrer le nom svp !!!',
                    'email.required'        =>'Veuillez Entrer le email svp !!!',
                    'password.required'     =>'Veuillez Choisir le password svp !!!'
                      //'password' => 'required|string|confirmed|min:6',
                ];
                $validator = Validator::make($request->all(),[
                    'name'           => 'required|string|between:2,100',
                    'email'          => 'required|string|email|max:100|unique:users',
                    'password'       => 'required|string|min:6'
                ],$message);
                
                if($validator->fails())
                {
                    return response()->json([
                        'err'=>$validator->errors()
                    ],500);
                }else{
                    User::create($request->all());
                    return response()->json([
                        'message' => 'New user created Succesfully !!!',
                        //'user' => $user
                    ], 201);
                }
        
    }

    public function login(Request $request){
        //dd($request->all());        
        /***************************************************************/
        $message=[
            'email.required'        =>'Veuillez Entrer l\'email svp !!!',
            'password.required'     =>'Veuillez Entrer votre password svp !!!'
              //'password' => 'required|string|confirmed|min:6',
        ];
        $validator = Validator::make($request->all(),[
            'email'          => 'required|string|email|max:100',
            'password'       => 'required|string|min:6'
        ],$message);
        
        if($validator->fails())
        {
            return response()->json([
                'err'=>$validator->errors()
            ],500);
        }else{
            $user = User::where('email', $request->email)->first();
     
            if (! $user || ! Hash::check($request->password, $user->password)) {
                $res1 = [
                    'status_code'=>400,
                    'message'=>'Email ou mot de passe incorrecte !!!'
                ];
                return response($res1,400);
            }else{
                //$the_user = Auth::user(); 
                $role = DB::SELECT("SELECT r.name as role_name  from roles r,users u, model_has_roles 
                where u.id = $user->id AND r.id = model_has_roles.role_id and model_has_roles.model_id = $user->id");
          
                if($role == []){
                    $role_name = "client";
                    //dd($role_name);
                }else{
                    $role_name = $role[0]->role_name;
                    //dd($role_name);
                }
                $token = $user->createToken('$request->device_name')->plainTextToken;
                $reponse = [
                    'role'=>$role_name,
                    'user'=>$user,
                    'token'=>$token,
                    'token_type'=>'Bearer',
                    'status_code'=>200
                ];
                return response($reponse,201);
            }
            
        }
    }
    /**
     * Token refresh
    */
   
    //Get the authenticated User Info
    public function user(){
        return response()->json(auth()->user());
    }
    //Log out the user (Invalidate the token)
    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json(['message'=>'Successfully logged Out !!!']);
    }

    
}
