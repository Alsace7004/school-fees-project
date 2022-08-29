<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScolariteController extends Controller
{
    public function getEtudiantScolariteInfo($id){
        $etudiant = DB::SELECT("SELECT etudiants.id,etudiants.nom,etudiants.prenom,filieres.scolarite_filiere,filieres.code_filiere,years.valeur_annee_scolaire,cycles.code_cycle
        FROM etudiants,filieres,years,cycles WHERE etudiants.filiere_id = filieres.id
        AND filieres.year_id = years.id AND filieres.cycle_id = cycles.id AND etudiants.id = $id");
        return $etudiant;
    }

    public function payerScolarite(Request $request){
        dd($request->all());
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
