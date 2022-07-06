<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class succursale extends Model
{
    use HasFactory;
    protected $fillable = ['ville_id','libelle_succursale','description_succursale'];

    public function ville(){
        return $this->belongsTo(ville::class);
    }
    public function etudiants(){
        return $this->hasMany(etudiant::class);
    }
}
