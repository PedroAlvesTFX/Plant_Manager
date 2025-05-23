<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $table = 'registro';
    protected $dates = ['data'];
   use HasFactory;

    protected $fillable = [
        'id_planta',
        'id_usuario',
        'descricao',
        'lat',
        'lon',
        'tipo',
        'data',
    ];

    public function plantas()
    {
        return $this->belongsToMany(Planta::class, 'planta_registro');
    }

    public function observacoes()
    {
        return $this->belongsToMany(Observacoes::class, 'observacoes_registro');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}