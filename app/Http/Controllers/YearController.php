<?php

namespace App\Http\Controllers;

use App\Models\year;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class YearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $years = year::latest()->get();
        return $years;
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
        $data=$request->validate([
            'valeur_annee_scolaire' => 'required',
        ]);
        return year::create($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\year  $year
     * @return \Illuminate\Http\Response
     */
    public function show(year $year)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\year  $year
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, year $year)
    {
        //
        return $year->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\year  $year
     * @return \Illuminate\Http\Response
     */
    public function destroy(year $year)
    {
        //
        return $year->delete();
    }

    public function countData(){
        $users = DB::SELECT("SELECT COUNT(*) as nbr_users FROM users");
        $etudiants = DB::SELECT("SELECT COUNT(*) as nbr_etudiants FROM etudiants");
        return compact('users','etudiants');
    }
}
