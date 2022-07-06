<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ville extends Model
{
    use HasFactory;
    protected $fillable = ['libelle_ville','description_ville'];

    public function succursales(){
        return $this->hasMany(succursale::class);
    }
}
