<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FraisScolarite;
use Illuminate\Support\Facades\DB;

class ScolariteController extends Controller
{
    public function getEtudiantScolariteInfo($id){
        $etudiant = DB::SELECT("SELECT etudiants.id,etudiants.nom,etudiants.prenom,etudiants.matricule,
        filieres.scolarite_filiere,filieres.code_filiere,filieres.libelle_filiere,
        years.valeur_annee_scolaire,
        years.id as year_id,cycles.code_cycle,cycles.libelle_cycle,succursales.libelle_succursale
        FROM etudiants,filieres,years,cycles,succursales 
        WHERE etudiants.filiere_id = filieres.id
        AND filieres.year_id = years.id 
        AND filieres.cycle_id = cycles.id
        AND etudiants.succursale_id = succursales.id 
        AND etudiants.id = $id");

        $mt = DB::SELECT("SELECT sum(frais_scolarites.montant_paye) as montant_payer 
        FROM frais_scolarites,etudiants 
        WHERE frais_scolarites.etudiant_id = etudiants.id
        AND etudiants.id = $id");
        return compact('etudiant','mt');
    }

    public function payerScolarite(Request $request){
        //dd($request->all());
        $p = new FraisScolarite();
        $p->montant_paye = $request->montant_paye;
        $p->etudiant_id = $request->etudiants_id;
        $p->year_id = $request->annee_scolaires_id;
        $p->save();
        return $p;
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
