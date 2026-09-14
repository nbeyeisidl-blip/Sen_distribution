<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        
        'nom',
        'prenom',
        'telephone',
        'email',
        'adresse',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}