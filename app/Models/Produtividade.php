<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produtividade extends Model
{
    protected $table = 'produtividade';
    public $timestamps = false;

    public function plantas()
    {
        return $this->belongsToMany(Planta::class, 'planta_produtividade');
    }
}
