<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'client_id',
        'total',
        'status',
        'discount',
        'payment_method',
         'shipping_address',
        'address',
        'phone',
    ];


    /**
     * Relation vers le client / utilisateur


    /**
     * Alias si vous utilisez user_id au lieu de client_id
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relation avec les articles/produits de la commande
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
    
}