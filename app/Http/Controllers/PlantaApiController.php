<?php

namespace App\Http\Controllers;
//namespace App\Http\Controllers\PlantaApiControlles;

use App\Http\Controllers\Controller;
use App\Models\Planta;
use App\Http\Resources\PlantaResource;
use App\Http\Resources\PlantaCollection;
use Illuminate\Http\Request;

class PlantaApiController extends Controller
{
    public function index()
    {
        $plantas = Planta::with(['classificacoes', 'nativas', 'imagens'])
            ->orderBy('nome_popular')
            ->paginate(20);
            
        return new PlantaCollection($plantas);
    }

    public function show(Planta $planta)
    {
        $planta->load([
            'classificacoes',
            'nativas',
            'crescimentos',
            'floracoes',
            'frutos',
            'produtividades',
            'imagens'
        ]);

        return new PlantaResource($planta);
    }

    public function search(Request $request)
    {
        $query = Planta::query();

        if ($request->has('nome')) {
            $query->where('nome_popular', 'like', '%' . $request->nome . '%')
                  ->orWhere('nome_cientifico', 'like', '%' . $request->nome . '%');
        }

        if ($request->has('apicola') && $request->apicola) {
            $query->where('e_apicola', true);
        }

        if ($request->has('panc') && $request->panc) {
            $query->where('e_panc', true);
        }

        $plantas = $query->with(['imagens'])->paginate(15);

        return new PlantaCollection($plantas);
    }
}