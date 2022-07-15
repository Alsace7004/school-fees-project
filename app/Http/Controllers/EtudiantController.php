<?php

namespace App\Http\Controllers;

use App\Models\Etudiant;
use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class EtudiantController extends Controller
{
    /*GET ONLY libelle_succursale AND use it on Etudiant Component SELECT*/
    public function succursales(){
        $succursales = DB::SELECT("SELECT libelle_succursale FROM `succursales` WHERE 1 ");
        return $succursales;
    }
    /*GET ONLY Something like IRT/L1/2015-2016 AND use it on Etudiant Component CREATE FORM*/
    public function concatFiliere(){
        $filiere = DB::SELECT("SELECT filieres.id,
        CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
        FROM filieres,cycles,years 
        WHERE 
        filieres.year_id = years.id AND filieres.cycle_id = cycles.id");
        return $filiere;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*$etudiants = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
        E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
        filieres.code_filiere
        FROM etudiants E,succursales,filieres
        WHERE  E.filiere_id = filieres.id 
        AND    E.succursale_id = succursales.id");*/
        $etudiants = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
        E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
        filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
        FROM etudiants E,succursales,filieres,cycles,years 
        WHERE  E.filiere_id = filieres.id 
        AND    E.succursale_id = succursales.id
        AND  filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
        return $etudiants;
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
        $message=[
                'nom.required'          =>'Veuillez Entrer le nom svp!!!',
                'prenom.required'       =>'Veuillez Entrer le prenom',
                'email.required'        =>'Veuillez Entrer le email',
                'genre.required'        =>'Veuillez Choisir le genre',
                'date_anniv.required'   =>'Veuillez Entrer la date d\'anniversaire',
                'contact_1.required'    =>'Veuillez Entrer le contact 1',
                'contact_2'=>'Entrer le contact 2',
                'adresse.required'      =>'Veuillez Entrer l\'adresse',
                'nationalite.required'  =>'Veuillez Entrer la nationalite',
                'matricule'=>'Entrer le matricule',
                'filiere_id.required'   =>'Veuillez Veuillez Choisir la filiere',
                'succursale_id.required'=>'Veuillez Choisir la succursale',
                'montant.required'      =>'Veuillez entrer le montant',
        ];
        $validator = Validator::make($request->all(),[
            'nom'           => 'required|string|max:255',
            'prenom'        => 'required|string|max:255',
            'email'         => 'required|string|email|max:255',
            'genre'         => 'required|string|max:255',
            'date_anniv'    => 'required|string|max:255',
            'contact_1'     => 'required|string|max:255',
            'contact_2'     => 'nullable|string|max:255',
            'nationalite'   => 'required|string|max:255',
            'adresse'       => 'required|string|max:255',
            'matricule'     => 'string|max:255',
            'filiere_id'    => 'required|integer',
            'succursale_id' => 'required|integer',
            'montant'       => 'required|numeric',
        ],$message);
        
        if($validator->fails())
        {
            return response()->json([
                'err'=>$validator->errors()
            ],500);
        }else{
            Etudiant::create($request->all());
            $etud_id = DB::table('etudiants')->latest('id')->first();
            $inscript = new Inscription();
            $inscript->montant = $request->montant;
            $inscript->etudiant_id = $etud_id->id;
            $inscript->save();
            $response = [
                'message'=>'Etudiant ajouté avec success',
            
            ];
            return response($response,201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function show(Etudiant $etudiant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Etudiant $etudiant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etudiant  $etudiant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Etudiant $etudiant)
    {
        //
    }

    public function onFilCycAnSuChange($Fil,$Cyc,$Ann,$Suc){
        /*return response()->json([
            'message'=>dd($suc)
        ],500);*/
      
        
        if(!$Cyc && !$Ann && !$Suc){    
            //#####################################################################
            //on recupere alors la filiere
            $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
            E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
            filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
            FROM etudiants E,succursales,filieres,cycles,years 
            WHERE  E.filiere_id = filieres.id 
            AND    E.succursale_id = succursales.id
            AND    filieres.code_filiere = '$Fil'
            AND    filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
            return $succursales;
        }else if(!$Fil && !$Ann && !$Suc ){
            //on recupere alors les cycles
            $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
            E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
            filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
            FROM etudiants E,succursales,filieres,cycles,years 
            WHERE  E.filiere_id = filieres.id 
            AND    E.succursale_id = succursales.id
            AND    cycles.libelle_cycle = '$Cyc'
            AND    filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
            return $succursales;
        }else if(!$Fil && !$Cyc && !$Suc ){
            //on recupere alors les annees
            $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
            E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
            filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
            FROM etudiants E,succursales,filieres,cycles,years 
            WHERE  E.filiere_id = filieres.id 
            AND    E.succursale_id = succursales.id
            AND    years.valeur_annee_scolaire = '$Ann'
            AND    filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
            return $succursales;
        }else if(!$Fil && !$Cyc && !$Ann ){
                //on recupere alors les succursales
                $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
                E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
                filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
                FROM etudiants E,succursales,filieres,cycles,years 
                WHERE  E.filiere_id = filieres.id 
                AND    E.succursale_id = succursales.id
                AND    succursales.libelle_succursale = '$Suc'
                AND    filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
                return $succursales;
        }else if(!$Ann && !$Suc){
            //#####################################################################
            //on recupere filiere + cycle
                $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
                E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
                filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
                FROM etudiants E,succursales,filieres,cycles,years 
                WHERE  E.filiere_id = filieres.id 
                AND    E.succursale_id = succursales.id
                    AND  filieres.code_filiere = '$Fil'
                    AND  cycles.libelle_cycle = '$Cyc'
                AND    filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
            return $succursales;
          
        }else if(!$Fil && !$Cyc){
            //on recupere Ann + Suc
                $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
                E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
                filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
                FROM etudiants E,succursales,filieres,cycles,years 
                WHERE  E.filiere_id = filieres.id 
                AND    E.succursale_id = succursales.id
                    AND  years.valeur_annee_scolaire = '$Ann'
                    AND  succursales.libelle_succursale = '$Suc'
                AND    filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
            return $succursales;
        }else if(!$Fil && !$Ann){
            //on recupere Cyc + Suc
                $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
                E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
                filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
                FROM etudiants E,succursales,filieres,cycles,years 
                WHERE  E.filiere_id = filieres.id 
                AND    E.succursale_id = succursales.id
                    AND  cycles.libelle_cycle = '$Cyc'
                    AND  succursales.libelle_succursale = '$Suc'
                AND    filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
            return $succursales;
        }else if(!$Cyc && !$Suc){
            //on recupere Fil + Ann
                $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
                E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
                filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
                FROM etudiants E,succursales,filieres,cycles,years 
                WHERE  E.filiere_id = filieres.id 
                AND    E.succursale_id = succursales.id
                    AND  filieres.code_filiere = '$Fil'
                    AND  years.valeur_annee_scolaire = '$Ann'
                AND    filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
            return $succursales;
        }else if(!$Cyc && !$Ann){
            //on recupere filiere + Succursale
                $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
                E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
                filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
                FROM etudiants E,succursales,filieres,cycles,years 
                WHERE  E.filiere_id = filieres.id 
                AND    E.succursale_id = succursales.id
                    AND  filieres.code_filiere = '$Fil'
                    AND  succursales.libelle_succursale = '$Suc'
                AND    filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
            return $succursales;
        }else if(!$Fil && !$Suc){
        //on recupere Cycle + Anne
                $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
                E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
                filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
                FROM etudiants E,succursales,filieres,cycles,years 
                WHERE  E.filiere_id = filieres.id 
                AND    E.succursale_id = succursales.id
                    AND  cycles.libelle_cycle = '$Cyc'
                    AND  years.valeur_annee_scolaire = '$Ann'
                AND    filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
            return $succursales;
        }else if(!$Suc){
            //#####################################################################
            //on recupere filiere + cycle + Ann
            $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
            E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
            filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
            FROM etudiants E,succursales,filieres,cycles,years 
            WHERE  E.filiere_id = filieres.id 
            AND    E.succursale_id = succursales.id
             	AND  filieres.code_filiere = '$Fil'
               	AND  cycles.libelle_cycle = '$Cyc'
               	AND  years.valeur_annee_scolaire = '$Ann'
            AND    filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
            return $succursales;
        }else if(!$Ann){
                //on recupere filiere + cycle + succursale
                $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
                E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
                filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
                FROM etudiants E,succursales,filieres,cycles,years 
                WHERE  E.filiere_id = filieres.id 
                AND    E.succursale_id = succursales.id
                    AND  filieres.code_filiere = '$Fil'
                    AND  cycles.libelle_cycle = '$Cyc'
                    AND  succursales.libelle_succursale = '$Suc'
                AND    filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
            return $succursales;
        }else if(!$Cyc){
            //on recupere filiere + Ann + succursale
                $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
                E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
                filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
                FROM etudiants E,succursales,filieres,cycles,years 
                WHERE  E.filiere_id = filieres.id 
                AND    E.succursale_id = succursales.id
                    AND  filieres.code_filiere = '$Fil'
                    AND  years.valeur_annee_scolaire = '$Ann'
                    AND  succursales.libelle_succursale = '$Suc'
                AND    filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
            return $succursales;
        }else if(!$Fil){
            //on recupere Cyc + Ann + succursale
                $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
                E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
                filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
                FROM etudiants E,succursales,filieres,cycles,years 
                WHERE  E.filiere_id = filieres.id 
                AND    E.succursale_id = succursales.id
                    AND  cycles.libelle_cycle = '$Cyc'
                    AND  years.valeur_annee_scolaire = '$Ann'
                    AND  succursales.libelle_succursale = '$Suc'
                AND    filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
            return $succursales;
        }else if($Fil && $Cyc && $Ann && $Suc){
            //#####################################################################
            $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
            E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
            filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
            FROM etudiants E,succursales,filieres,cycles,years 
            WHERE  E.filiere_id = filieres.id 
            AND    E.succursale_id = succursales.id
                    AND  filieres.code_filiere = '$Fil'
                    AND  cycles.libelle_cycle = '$Cyc'
                    AND  years.valeur_annee_scolaire = '$Ann'
                    AND  succursales.libelle_succursale = '$Suc'
            AND  filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
            return $succursales;
        }else if(($Fil==0) && ($Cyc==0) && ($Ann==0) && ($Suc==0)){
            $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
            E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
            filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
            FROM etudiants E,succursales,filieres,cycles,years 
            WHERE  E.filiere_id = filieres.id 
            AND    E.succursale_id = succursales.id
            AND  filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
            return $succursales;
        }else{
            $succursales = DB::SELECT("SELECT E.id,E.nom,E.prenom,E.email,E.genre,E.date_anniv,E.contact_1,E.contact_2,
            E.adresse,E.nationalite,E.matricule,E.created_at,succursales.libelle_succursale,
            filieres.code_filiere, CONCAT(filieres.code_filiere,'/',cycles.code_cycle,'/',years.valeur_annee_scolaire) as valeur_filiere
            FROM etudiants E,succursales,filieres,cycles,years 
            WHERE  E.filiere_id = filieres.id 
            AND    E.succursale_id = succursales.id
            AND  filieres.year_id = years.id AND filieres.cycle_id = cycles.id;");
            return $succursales;
        }
    }
}
