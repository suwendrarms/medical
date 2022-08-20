<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class drug extends Model
{
    protected $fillable = [
        'name', 'price', 'status'
    ];
}
