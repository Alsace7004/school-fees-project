<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class filiere extends Model
{
    use HasFactory;
    protected $fillable = ['year_id','cycle_id','code_filiere','libelle_filiere','description_filiere','scolarite_filiere'];

    public function year(){
        return $this->belongsTo(year::class);
    }
    public function etudiants(){
        return $this->hasMany(etudiant::class);
    }
    public function cycle(){
        return $this->belongsTo(Cycle::class);
    }
}
