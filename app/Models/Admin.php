<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;

class Admin extends Model
{
    protected $connection = 'mongodb';

    protected $fillable = [
        'name',
        'email',
        'password',
        'shop_id'    // ← add this
    ];
}