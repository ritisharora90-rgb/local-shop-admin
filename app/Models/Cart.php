<?php

namespace App\Models;

// IMPORTANT: Use the MongoDB Eloquent Model base instead of the default Laravel one
use MongoDB\Laravel\Eloquent\Model; 

class Cart extends Model
{
    // Tells Laravel to look at your MongoDB connection configuration
    protected $connection = 'mongodb'; 

    // Defines the name of the collection in your Atlas dashboard
    protected $collection = 'carts';

    protected $fillable = [
        'user_id',
        'items'
    ];

    /**
     * THE GOLDEN FIX:
     * This explicitly forces Laravel to cast the 'items' data field into a 
     * clean native BSON/JSON Array instead of compiling it into a string wrapper.
     */
    protected $casts = [
        'items' => 'array',
    ];
}