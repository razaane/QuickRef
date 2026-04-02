<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'matchs'; // Bach n-t-akdo bli k-y-chouf table 'matchs'

    protected $fillable = [
        'equipe_domicile_id', 
        'equipe_visiteur_id', 
        'categorie_id',
        'arbitre_central_id', 
        'arbitre_assistant1_id', 
        'arbitre_assistant2_id', 
        'quatrieme_arbitre_id',
        'date_heure', 
        'terrain', 
        'ville', 
        'statut'
    ];

    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }

    public function arbitreCentral()
    {
        return $this->belongsTo(Arbitre::class, 'arbitre_central_id');
    }

    public function assistant1()
    {
        return $this->belongsTo(Arbitre::class, 'arbitre_assistant1_id');
    }

    public function assistant2()
    {
        return $this->belongsTo(Arbitre::class, 'arbitre_assistant2_id');
    }

    public function quatrieme()
    {
        return $this->belongsTo(Arbitre::class, 'quatrieme_arbitre_id');
    }

    public function equipeDomicile()
    {
        return $this->belongsTo(Equipe::class, 'equipe_domicile_id');
    }

    public function equipeVisiteur()
    {
        return $this->belongsTo(Equipe::class, 'equipe_visiteur_id');
    }
}