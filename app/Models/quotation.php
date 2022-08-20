<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class quotation extends Model
{
    protected $fillable = [
        'prescription_id','user_id', 'amount','status'
    ];
}
