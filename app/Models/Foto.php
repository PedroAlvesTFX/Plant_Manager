<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $fillable = ['planta_id', 'caminho', 'latitude', 'longitude'];

    public function planta()
    {
        return $this->belongsTo(Planta::class);
    }
}