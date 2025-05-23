<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planta extends Model
{
    protected $table = 'plantas';
    protected $dates = ['data', 'created_at', 'updated_at'];


  use HasFactory;

    protected $fillable = [
        'nome_cientifico',
        'nome_popular','e_panc','e_apicola','e_forrageira',
        'familia',
        // outros campos que desejar permitir
    ];

    public function classificacoes()
    {
        return $this->belongsToMany(Classificacao::class, 'planta_classificacao');
    }

    public function crescimentos()
    {
        return $this->belongsToMany(Crescimento::class, 'planta_crescimento');
    }

    public function floracoes()
    {
        return $this->belongsToMany(Floracao::class, 'planta_floracao');
    }

    public function frutos()
    {
        return $this->belongsToMany(Fruto::class, 'planta_fruto');
    }

    public function imagens()
    {
        return $this->hasMany(ImagemPlanta::class, 'id_planta');
    }

    public function nativas()
    {
        return $this->belongsToMany(Nativa::class, 'planta_nativa');
    }

    public function produtividades()
    {
        return $this->belongsToMany(Produtividade::class, 'planta_produtividade');
    }

    public function registros()
    {
        return $this->belongsToMany(Registro::class, 'planta_registro');
    }
}