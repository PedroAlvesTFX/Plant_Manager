<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Floracao extends Model
{
    protected $table = 'floracao';
    protected $dates = ['data'];

    public function plantas()
    {
        return $this->belongsToMany(Planta::class, 'planta_floracao');
    }
}