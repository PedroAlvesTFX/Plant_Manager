<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Observacoes extends Model
{
    protected $table = 'observacoes';
    protected $dates = ['data'];

    public function registros()
    {
        return $this->belongsToMany(Registro::class, 'observacoes_registro');
    }

    public function usuario()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
}
