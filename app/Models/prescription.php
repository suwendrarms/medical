<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class prescription extends Model
{
    protected $fillable = [
        'user_id', 'note', 'delivery_address_line1','delivery_address_line2','delivery_address_line3','time_slot','date','status'
    ];
}
