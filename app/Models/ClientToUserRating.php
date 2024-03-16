<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientToUserRating extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'client_id', 'rating', 'comment'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
