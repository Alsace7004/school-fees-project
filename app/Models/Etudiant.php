<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;
    protected $fillable = [
        'nom','prenom','email',
        'genre','date_anniv','contact_1',
        'contact_2','adresse','nationalite',
        'matricule',
        'filiere_id','succursale_id'
    ];

    public function year(){
        return $this->belongsTo(year::class);
    }
    public function filiere(){
        return $this->belongsTo(filiere::class);
    }
    public function succursale(){
        return $this->belongsTo(succursale::class);
    }
}
