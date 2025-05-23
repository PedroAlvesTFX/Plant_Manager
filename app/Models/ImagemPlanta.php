<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImagemPlanta extends Model
{
    protected $table = 'imagens_planta';
    protected $dates = ['data_created'];

    public function planta()
    {
        return $this->belongsTo(Planta::class, 'id_planta');
    }
}