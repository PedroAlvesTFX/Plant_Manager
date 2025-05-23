<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classificacao extends Model
{
    protected $table = 'classificacao';
    public $timestamps = false;

    public function plantas()
    {
        return $this->belongsToMany(Planta::class, 'planta_classificacao');
    }
}