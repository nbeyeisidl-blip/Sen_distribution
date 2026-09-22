<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'parent_id',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relation pour obtenir la catégorie parente
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Relation pour obtenir les sous-catégories d'une catégorie
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
    public function products(): HasMany
    {
        return $this->hasMany(Product::class);
    }
}