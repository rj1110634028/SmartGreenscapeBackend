<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'mac_address',
        'min_temperature',
        'min_humidity',
        'min_soil_humidity',
        'max_temperature',
        'max_humidity',
        'max_soil_humidity',
    ];

    public function data()
    {
        return $this->hasMany(Data::class);
    }
}
