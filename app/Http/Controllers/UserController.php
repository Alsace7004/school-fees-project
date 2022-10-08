<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Etudiant;
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

    public function getBooks(Request $request)
    {
        //$data = Etudiant::where('matricule', 'LIKE','%'.$request->keyword.'%')->get();
        /*dd($request->keyword);
        die();*/
        $data = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
        E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
        filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
        FROM etudiants E,succursales,filieres,cycles,years 
        WHERE  E.filiere_id = filieres.id 
        AND    E.succursale_id = succursales.id
        AND  filieres.year_id = years.id AND filieres.cycle_id = cycles.id
        AND E.matricule LIKE '$request->keyword' ");
      
        return response()->json($data); 
    }
}
