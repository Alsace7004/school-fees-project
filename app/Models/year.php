<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class year extends Model
{
    use HasFactory;
    protected $fillable = ['valeur_annee_scolaire'];

    public function filieres(){
        return $this->hasMany(filiere::class);
    }
    public function etudiants(){
        return $this->hasMany(etudiant::class);
    }
}
