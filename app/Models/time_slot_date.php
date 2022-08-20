<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class time_slot_date extends Model
{
    use HasFactory;
    protected $fillable = [
        'date','start_time', 'end_time','slot','status'
    ];
}
