<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['temperature', 'humidity', 'soil_humidity', 'time', 'mac_address'];

    protected $hidden = ['id', 'plant_id'];

    public function plant()
    {
        return $this->belongsTo(Plant::class, 'mac_address', 'mac_address');
    }
}
