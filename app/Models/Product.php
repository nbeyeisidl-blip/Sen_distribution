<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    'name',
    'description',
    'price',
    'stock',
    'category_id',
    'image',
    'external_source',
    'external_ref',
    'size',
    'color',
    'gender',
];

public function comments()
    {
        return $this->hasMany(Comment::class)->latest(); // Pour avoir les plus récents en premier
    }
    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'category_id'
        );
    }
}