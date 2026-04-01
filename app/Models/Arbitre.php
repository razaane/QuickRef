<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Arbitre extends Model {

    protected $fillable = [
        'user_id', 'telephone', 'grade', 'adresse',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}