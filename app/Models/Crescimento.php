<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crescimento extends Model
{
    protected $table = 'crescimento';
    public $timestamps = false;

    public function plantas()
    {
        return $this->belongsToMany(Planta::class, 'planta_crescimento');
    }
}