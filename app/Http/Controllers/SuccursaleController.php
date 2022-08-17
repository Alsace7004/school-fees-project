<?php

namespace App\Http\Controllers;

use App\Models\succursale;
use App\Models\ville;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuccursaleController extends Controller
{
    public function villes(){
        $villes = ville::all();
        
        return $villes;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$succursales = succursale::all();
        $succursales = DB::SELECT('SELECT succursales.id as id,libelle_succursale,libelle_ville FROM succursales,villes WHERE succursales.ville_id= villes.id ');

        return $succursales;
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
            'libelle_succursale'=>'required',
            'description_succursale'=>'',
            'ville_id'=>'required'
        ]);
        return succursale::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\succursale  $succursale
     * @return \Illuminate\Http\Response
     */
    public function show(succursale $succursale)
    {
        //
        return $succursale;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\succursale  $succursale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, succursale $succursale)
    {
        //
        $data = $request->validate([
            'libelle_succursale'=>'required',
            'description_succursale'=>'',
            'ville_id'=>'required'
        ]);
        return $succursale->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\succursale  $succursale
     * @return \Illuminate\Http\Response
     */
    public function destroy(succursale $succursale)
    {
        //
        return $succursale->delete();
    }

    public function nbrEtudiantParSuccursale(){
        $nombres = DB::SELECT("SELECT succursales.libelle_succursale, COUNT(*) as nbr_etudiants FROM succursales,etudiants
        WHERE etudiants.succursale_id = succursales.id GROUP BY succursales.libelle_succursale");
        return $nombres;
    }
}
