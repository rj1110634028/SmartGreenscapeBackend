<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'mac_address', 'temperature', 'humidity', 'soil_humidity'];

    public function data()
    {
        return $this->hasMany(Data::class);
    }
}
