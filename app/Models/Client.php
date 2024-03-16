<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = ['first_name', 'last_name', 'email'];

    public function userToClientRatings()
    {
        return $this->hasMany(UserToClientRating::class);
    }

    public function getFullname()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function clientToUserRatings()
    {
        return $this->hasMany(ClientToUserRating::class);
    }
    
}
