<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cycle extends Model
{
    use HasFactory;

    protected $fillable = ['code_cycle','libelle_cycle'];

    public function filieres(){
        return $this->hasMany(filiere::class);
    }
}
