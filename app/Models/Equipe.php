<?php

namespace App\Models;
use App\Models\categorie;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    use SoftDeletes;
    protected $fillable = ['nom', 'ville'];

    public function categorie(){
        return $this->hasOne(Categorie::class);
    }
    
}


