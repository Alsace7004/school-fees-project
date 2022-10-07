<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index(){
        //$users = User::all();
        //dd($users);
        $users = DB::SELECT("SELECT 
        u.id,u.name,u.email,u.created_at,r.name as role_name 
        FROM users u,roles r,model_has_roles 
        WHERE u.id = model_has_roles.model_id 
        AND r.id = model_has_roles.role_id 
        ORDER BY u.name ASC ");
        return $users;
    }

    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'roles' => 'required'
        ]);
        $inputs = $request->all();
        $inputs['password'] = bcrypt($inputs['password']);
        $user = User::create($inputs);
        $user->assignRole($request->input('roles'));
        return $user;
    }

    public function show(User $user)
    {
        //
        /*$userRoles = DB::SELECT("SELECT r.name as role_name from roles r inner join model_has_roles where r.id = model_has_roles.role_id and model_has_roles.model_id = ('.$user->id.') ");
        return [$user,$userRoles];*/
        $users = DB::SELECT("SELECT u.id,u.name,
        u.email,u.created_at,r.id as role_id,
        r.name as role_name from roles r,users u, model_has_roles 
        where u.id = $user->id AND 
        r.id = model_has_roles.role_id 
        and model_has_roles.model_id = $user->id");
        return $users;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        //dd($request->roles);
        $this->validate($request, [
            'name'=>'required|string|max:255',
            'email' => 'required|email',
            'roles' => 'required'
        ]);
        $inputs = $request->all();
        if(!empty($inputs['password'])){ 
            $inputs['password'] = bcrypt($inputs['password']);
        }else{
            $inputs = Arr::except($inputs,array('password'));    
        }
        $user->update($inputs);
        $user->syncRoles($request->roles);
        return $user;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
        if($user->delete()){
            return response()->json([
                'success'=>'User supprimé avec success'
            ],200);
        }else{
            return response()->json([
                'error'=>'an error occured'
            ],404);
        }
    }
}
