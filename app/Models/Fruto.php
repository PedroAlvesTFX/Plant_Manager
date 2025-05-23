<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fruto extends Model
{
    protected $table = 'fruto';
    protected $dates = ['data'];

    public function plantas()
    {
        return $this->belongsToMany(Planta::class, 'planta_fruto');
    }
}
