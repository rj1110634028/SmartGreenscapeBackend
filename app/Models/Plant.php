<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = [
        'mac_address',
        'min_temperature',
        'min_humidity',
        'min_soil_humidity',
        'max_temperature',
        'max_humidity',
        'max_soil_humidity',
    ];

    protected $primaryKey = 'mac_address';

    public function data()
    {
        return $this->hasMany(Data::class, 'mac_address', 'mac_address');
    }
}
