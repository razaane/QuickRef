<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Arbitre;
use Illuminate\Database\Eloquent\SoftDeletes;



class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */

        protected $fillable = [
        'name', 'email', 'password', 'role',
        ];


    public function isAdmin(): bool {
        return $this->role === 'admin';
    }

    public function isArbitre(): bool {
        return $this->role === 'arbitre';
    }

    public function arbitre() {
        return $this->hasOne(Arbitre::class);
    }


    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
