<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class Arbitre extends Model {
    
    protected $fillable = [
        'user_id', 'telephone', 'grade', 'adresse',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    //for paiments

    public function matchesAsCentral(): HasMany
    {
        return $this->hasMany(Game::class, 'arbitre_central_id');
    }

    public function matchesAsAssistant1(): HasMany
    {
        return $this->hasMany(Game::class, 'arbitre_assistant1_id');
    }

    public function matchesAsAssistant2(): HasMany
    {
        return $this->hasMany(Game::class, 'arbitre_assistant2_id');
    }

    public function matchesAsQuatrieme(): HasMany
    {
        return $this->hasMany(Game::class, 'quatrieme_arbitre_id');
    }
}