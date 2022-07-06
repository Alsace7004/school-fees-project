<?php

namespace App\Http\Controllers;

use App\Models\filiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FiliereController extends Controller
{
    public function filieres(){
        $filieres = DB::SELECT('SELECT DISTINCT code_filiere FROM filieres');
        return $filieres;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $filiere = DB::SELECT('SELECT filieres.id as id,code_filiere,libelle_filiere,scolarite_filiere,valeur_annee_scolaire,code_cycle,libelle_cycle
        FROM filieres,years,cycles 
        WHERE filieres.cycle_id= cycles.id 
        AND
        filieres.year_id = years.id ORDER BY filieres.created_at DESC');
        return $filiere;
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
        $data = $request->validate([
            'code_filiere'=>'required',
            'libelle_filiere'=>'required',
            'description_filiere'=>'required',
            'scolarite_filiere'=>'required',
            'year_id'=>'required',
            'cycle_id'=>'required',
        ]);
        return filiere::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\filiere  $filiere
     * @return \Illuminate\Http\Response
     */
    public function show(filiere $filiere)
    {
        //
        return $filiere;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\filiere  $filiere
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, filiere $filiere)
    {
        //
        $data = $request->validate([
            'code_filiere'=>'required',
            'libelle_filiere'=>'required',
            'scolarite_filiere'=>'required',
            'year_id'=>'required',
            'cycle_id'=>'required',
        ]);
        return $filiere->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\filiere  $filiere
     * @return \Illuminate\Http\Response
     */
    public function destroy(filiere $filiere)
    {
        //
        return $filiere->delete();
    }

    public function onFiliereChange($dev,$Ann='0',$Cyc=null){
       /*if($dev){
            //dd($dev);
            $filieres = DB::SELECT("SELECT DISTINCT filieres.id as id,code_filiere,libelle_filiere,scolarite_filiere,valeur_annee_scolaire,code_cycle,libelle_cycle
            FROM filieres,years,cycles 
            WHERE filieres.year_id = years.id
            AND filieres.cycle_id = cycles.id 
            AND filieres.code_filiere= '$dev' ");
            //dd($filieres);
            return $filieres;
       }elseif($Ann){
            dd($Ann);
            $filieres = DB::SELECT("SELECT DISTINCT filieres.id as id,code_filiere,libelle_filiere,scolarite_filiere,valeur_annee_scolaire,code_cycle,libelle_cycle
            FROM filieres,years,cycles 
            WHERE filieres.year_id = years.id
            AND filieres.cycle_id = cycles.id 
            AND years.valeur_annee_scolaire='$Ann'");
            //dd($filieres);
            return $filieres;
       }elseif($Cyc){
             //dd($Ann);
            $filieres = DB::SELECT("SELECT DISTINCT filieres.id as id,code_filiere,libelle_filiere,scolarite_filiere,valeur_annee_scolaire,code_cycle,libelle_cycle 
            FROM filieres,years,cycles 
            WHERE filieres.year_id = years.id 
            AND filieres.cycle_id = cycles.id 
            AND cycles.libelle_cycle = '$Cyc' ");
            //dd($filieres);
            return $filieres;
       }elseif($dev && $Ann){
            $filieres = DB::SELECT("SELECT DISTINCT filieres.id as id,code_filiere,libelle_filiere,scolarite_filiere,valeur_annee_scolaire,code_cycle,libelle_cycle
            FROM filieres,years,cycles 
            WHERE filieres.year_id = years.id
            AND filieres.cycle_id = cycles.id 
            AND filieres.code_filiere='$dev' 
            AND years.valeur_annee_scolaire='$Ann'");
            //dd($filieres);
            return $filieres;
       }elseif($dev && $Cyc){
            $filieres = DB::SELECT("SELECT DISTINCT filieres.id as id,code_filiere,libelle_filiere,scolarite_filiere,valeur_annee_scolaire,code_cycle,libelle_cycle
            FROM filieres,years,cycles 
            WHERE filieres.year_id = years.id
            AND filieres.cycle_id = cycles.id 
            AND filieres.code_filiere='$dev' 
            AND cycles.code_cycle = '$Cyc'");
            //dd($filieres);
            return $filieres;
       }elseif($Ann && $Cyc){
            $filieres = DB::SELECT("SELECT DISTINCT filieres.id as id,code_filiere,libelle_filiere,scolarite_filiere,valeur_annee_scolaire,code_cycle,libelle_cycle
            FROM filieres,years,cycles 
            WHERE filieres.year_id = years.id
            AND filieres.cycle_id = cycles.id 
            AND cycles.code_cycle = '$Cyc'
            AND years.valeur_annee_scolaire='$Ann'");
            //dd($filieres);
            return $filieres;
       }elseif($dev && $Ann && $Cyc){
            $filieres = DB::SELECT("SELECT DISTINCT filieres.id as id,code_filiere,libelle_filiere,scolarite_filiere,valeur_annee_scolaire,code_cycle,libelle_cycle
            FROM filieres,years,cycles 
            WHERE filieres.year_id = years.id
            AND filieres.cycle_id = cycles.id 
            AND filieres.code_filiere='$dev' 
            AND cycles.code_cycle = '$Cyc'
            AND years.valeur_annee_scolaire='$Ann'");
            //dd($filieres);
            return $filieres;
       }*/

       
       if(!$Ann && !$Cyc){
            //dd($dev);
            $filieres = DB::SELECT("SELECT DISTINCT filieres.id as id,code_filiere,libelle_filiere,scolarite_filiere,valeur_annee_scolaire,code_cycle,libelle_cycle
            FROM filieres,years,cycles 
            WHERE filieres.year_id = years.id
            AND filieres.cycle_id = cycles.id 
            AND filieres.code_filiere= '$dev' ");
            //dd($filieres);
            return $filieres;
       }elseif(!$Cyc){
           //dd($Ann);
            $filieres = DB::SELECT("SELECT DISTINCT filieres.id as id,code_filiere,libelle_filiere,scolarite_filiere,valeur_annee_scolaire,code_cycle,libelle_cycle
            FROM filieres,years,cycles 
            WHERE filieres.year_id = years.id
            AND filieres.cycle_id = cycles.id 
            AND filieres.code_filiere='$dev' 
            AND years.valeur_annee_scolaire='$Ann'");
            //dd($filieres);
            return $filieres;
       }elseif(!$Ann){
            //dd($Ann);   
           //dd("ok");
           
      
            $filieres = DB::SELECT("SELECT DISTINCT filieres.id as id,code_filiere,libelle_filiere,scolarite_filiere,valeur_annee_scolaire,code_cycle,libelle_cycle
            FROM filieres,years,cycles 
            WHERE filieres.year_id = years.id
            AND filieres.cycle_id = cycles.id 
            AND filieres.code_filiere='$dev' 
            AND cycles.libelle_cycle = '$Cyc'");
            //dd($filieres);
            return $filieres;
        }else{
           //dd("ok");
            $filieres = DB::SELECT("SELECT DISTINCT filieres.id as id,code_filiere,libelle_filiere,scolarite_filiere,valeur_annee_scolaire,code_cycle,libelle_cycle
            FROM filieres,years,cycles 
            WHERE filieres.year_id = years.id
            AND filieres.cycle_id = cycles.id 
            AND filieres.code_filiere='$dev' 
            AND cycles.libelle_cycle = '$Cyc'
            AND years.valeur_annee_scolaire='$Ann'");
            //dd($filieres);
            return $filieres;
       }
       
    }
    //AND filieres.code_filiere=('.$fil.')");
}

/*
recuperation des filieres selon un code filiere donné

SELECT DISTINCT filieres.id as id,code_filiere,libelle_filiere,scolarite_filiere,valeur_annee_scolaire,code_cycle,libelle_cycle
FROM filieres,years,cycles 
WHERE filieres.year_id = years.id
AND filieres.cycle_id = cycles.id 
AND filieres.code_filiere='IRT'     
*/
/***************************************************************************/
/*
recuperation des filieres selon un cycle(l1,l2,l3,m1,2) un donné

SELECT DISTINCT filieres.id as id,code_filiere,libelle_filiere,scolarite_filiere,valeur_annee_scolaire,code_cycle,libelle_cycle 
FROM filieres,years,cycles 
WHERE filieres.year_id = years.id 
AND filieres.cycle_id = cycles.id 
AND cycles.code_cycle = 'l1' 
*/
/***************************************************************************/
/*
recuperation des filieres selon une année scolaire un donné

SELECT DISTINCT filieres.id as id,code_filiere,libelle_filiere,scolarite_filiere,valeur_annee_scolaire,code_cycle,libelle_cycle
FROM filieres,years,cycles 
WHERE filieres.year_id = years.id
AND filieres.cycle_id = cycles.id 
AND years.valeur_annee_scolaire='2015-2016'
*/
/***************************************************************************/
/* 
toute valeurs dinamiques

SELECT DISTINCT filieres.id as id,code_filiere,libelle_filiere,scolarite_filiere,valeur_annee_scolaire,code_cycle,libelle_cycle
FROM filieres,years,cycles 
WHERE filieres.year_id = years.id
AND filieres.cycle_id = cycles.id 
AND filieres.code_filiere='IRT' 
AND cycles.code_cycle = 'l1'
AND years.valeur_annee_scolaire='2015-2016'
*/
/***************************************************************************/