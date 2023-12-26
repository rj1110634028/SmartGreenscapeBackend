<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $fillable = ['temperature', 'humidity', 'soil_humidity', 'time'];

    public function plant()
    {
        return $this->belongsTo(Plant::class);
    }
}
