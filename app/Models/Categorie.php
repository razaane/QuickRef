<?php

namespace App\Models;
use App\Models\Equipe;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    protected $fillable = ['nom', 'montant'];
    
    public function equipes() { 
        return $this->hasMany(Equipe::class);
    }
    
}
