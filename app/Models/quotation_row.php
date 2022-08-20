<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class quotation_row extends Model
{
    protected $fillable = [
        'quotation_id', 'drug', 'qtr','amount','status'
    ];
}
