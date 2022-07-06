<?php

namespace App\Http\Controllers;

use App\Models\ville;
use Illuminate\Http\Request;

class VilleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $villes = ville::latest()->get();
        return $villes;
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
            'libelle_ville'=>'required',
            'description_ville'=>'required'
        ]);
        return ville::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function show(ville $ville)
    {
        //
        return $ville;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ville $ville)
    {
        //
        $data = $request->validate([
            'libelle_ville'=>'required',
            'description_ville'=>'required'
        ]);
        return $ville->update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ville  $ville
     * @return \Illuminate\Http\Response
     */
    public function destroy(ville $ville)
    {
        //
        return $ville->delete();
    }
}
