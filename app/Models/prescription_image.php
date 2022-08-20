<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class prescription_image extends Model
{
    protected $fillable = [
        'prescription_id', 'url', 'status'
    ];
}
