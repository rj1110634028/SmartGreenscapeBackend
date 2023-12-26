<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DefaultClass extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'min_temperature',
        'min_humidity',
        'min_soil_humidity',
        'max_temperature',
        'max_humidity',
        'max_soil_humidity',
    ];
}
