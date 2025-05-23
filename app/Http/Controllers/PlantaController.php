<?php

namespace App\Http\Controllers;

use App\Models\Planta;
use App\Models\Classificacao;
use App\Models\Crescimento;
use App\Models\Floracao;
use App\Models\Fruto;
use App\Models\Nativa;
use App\Models\Produtividade;
use App\Models\ImagemPlanta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PlantaController extends Controller
{
    public function index()
    {
//$plantas = Planta::paginate(10); // ou ->simplePaginate(10)

//return view('plantas.index', compact('plantas'));
//   return view('plantas.index', ['plantas' => Planta::all()]);
    // Carrega apenas os relacionamentos necessários
    $plantas = Planta::with(['floracoes:id,mes_floracao','frutos:id,mes_frutos','classificacoes:id,classificacao', 'imagens:id,id_planta,caminho'])
        ->select(['id', 'nome_popular', 'especie', 'e_apicola', 'e_panc','e_forrageira'])
        ->where('nome_popular', 'ILIKE', "%".request('search')."%")
        ->orderBy('nome_popular')
        ->paginate(10); // Reduza o número de itens por página
        return view('plantas.index', compact('plantas'));



//   $busca = $request->input('busca');

//    $plantas = Planta::when($busca, function ($query, $busca) {
//        return $query->where('nome_popular', 'ILIKE', "%{$busca}%");
//    })
//    ->orderBy('id', 'desc')
//    ->take(10)
//    ->get();




    }


    public function list()
    {
        return view('planta.index', ['plantas' => Planta::all()]);
    }


    public function create()
    {
        $classificacoes = Classificacao::all();
        $nativas = Nativa::all();
        $crescimentos = Crescimento::all();
        $floracoes = Floracao::all();
        $frutos = Fruto::all();
        $produtividades = Produtividade::all();
        
        return view('plantas.create', compact(
            'classificacoes',
            'nativas',
            'crescimentos',
            'floracoes',
            'frutos',
            'produtividades'
        ));
    }

    public function store(Request $request)
    {
        $request['e_panc'] = $request['e_panc'] === 'on' ? 1 : 0;
        $request['e_apicola'] = $request['e_apicola'] === 'on' ? 1 : 0;
        $request['e_forrageira'] = $request['e_forrageira'] === 'on' ? 1 : 0;
        $validated = $request->validate([
            'nome_popular' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'e_apicola' => 'boolean',
            'e_panc' => 'boolean',
            'e_forrageira' => 'boolean',
            'cor_fruto' => 'nullable|string|max:50',
            'cor_flor' => 'nullable|string|max:50',
            'cor_folha' => 'nullable|string|max:50',
            'classificacoes' => 'nullable|array',
            'classificacoes.*' => 'exists:classificacao,id',
            'nativas' => 'nullable|array',
            'nativas.*' => 'exists:nativa,id',
            'crescimentos' => 'nullable|array',
            'crescimentos.*' => 'exists:crescimento,id',
            'floracoes' => 'nullable|array',
            'floracoes.*' => 'exists:floracao,id',
            'frutos' => 'nullable|array',
            'frutos.*' => 'exists:fruto,id',
            'produtividades' => 'nullable|array',
            'produtividades.*' => 'exists:produtividade,id',
            'imagens' => 'nullable|array',
            'imagens.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $planta = Planta::create($validated);

        // Sync relations
        $this->syncRelations($planta, $validated);

        // Handle image upload
        if ($request->hasFile('imagens')) {
            $this->uploadImagens($planta, $request->file('imagens'));
        }

        return redirect()->route('plantas.show', $planta)
            ->with('success', 'Planta cadastrada com muito sucesso!');
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
            'imagens',
            'registros' => function($query) {
                $query->with('usuario', 'observacoes');
            }
        ]);

        return view('plantas.show', compact('planta'));
    }

    public function edit(Planta $planta)
    {
        $planta->load(['classificacoes', 'nativas', 'crescimentos', 'floracoes', 'frutos', 'produtividades']);
        
        $classificacoes = Classificacao::all();
        $nativas = Nativa::all();
        $crescimentos = Crescimento::all();
        $floracoes = Floracao::all();
        $frutos = Fruto::all();
        $produtividades = Produtividade::all();
        
        return view('plantas.edit', compact(
            'planta',
            'classificacoes',
            'nativas',
            'crescimentos',
            'floracoes',
            'frutos',
            'produtividades'
        ));
    }

    public function judit($id)
    {

    $planta = Planta::find($id);
    return view('plantas.judit', compact('planta'));
    }



    public function update(Request $request, Planta $planta)
    {
        $request['e_panc'] = $request['e_panc'] === 'on' ? 1 : 0;
        $request['e_apicola'] = $request['e_apicola'] === 'on' ? 1 : 0;
        $request['e_forrageira'] = $request['e_forrageira'] === 'on' ? 1 : 0;
        $validated = $request->validate([

            'nome_popular' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'e_panc' => 'boolean',
            'e_forrageira' => 'boolean',
            'e_apicola' => 'boolean',
/*            ,'cor_fruto' => 'nullable|string|max:50',
            'cor_flor' => 'nullable|string|max:50',
            'cor_folha' => 'nullable|string|max:50',
            'classificacoes' => 'nullable|array',
            'classificacoes.*' => 'exists:classificacao,id',
            'nativas' => 'nullable|array',
            'nativas.*' => 'exists:nativa,id',
            'crescimentos' => 'nullable|array',
            'crescimentos.*' => 'exists:crescimento,id',
            'floracoes' => 'nullable|array',
            'floracoes.*' => 'exists:floracao,id',
            'frutos' => 'nullable|array',
            'frutos.*' => 'exists:fruto,id',
            'produtividades' => 'nullable|array',
            'produtividades.*' => 'exists:produtividade,id',
            'imagens' => 'nullable|array',
            'imagens.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
*/
        ]);

        $planta->update($validated);

        $planta = Planta::findOrFail($request->id);
        $planta->nome_popular    = $request->nome_popular;
        $planta->especie = $request->especie;
        $planta->e_apicola       = $request->e_apicola;
        $planta->e_forrageira    = $request->e_forrageira;
        $planta->e_panc    = $request->e_panc;
        $planta->save();


        // Sync relations
        $this->syncRelations($planta, $validated);

        // Handle image upload
        if ($request->hasFile('imagens')) {
            $this->uploadImagens($planta, $request->file('imagens'));
        }

        return redirect()->route('plantas.index', $planta)
//        return redirect()->route('plantas.show', $planta)
            ->with('success', 'Planta '.$request['e_panc'].' id:'.$request['id'].' atualizada com sucesso relativo!'.$planta->nome_popular);
    }

    public function destroy(Planta $planta)
    {
        // Delete associated images
        foreach ($planta->imagens as $imagem) {
            Storage::delete($imagem->caminho);
            $imagem->delete();
        }

        $planta->delete();

        return redirect()->route('plantas.index')
            ->with('success', 'Planta removida com sucesso!');
    }

    public function deleteImage(Planta $planta, ImagemPlanta $imagem)
    {
        if ($imagem->id_planta === $planta->id) {
            Storage::delete($imagem->caminho);
            $imagem->delete();
            
            return back()->with('success', 'Imagem removida com sucesso!');
        }
        
        return back()->with('error', 'Imagem não pertence a esta planta!');
    }

    protected function syncRelations(Planta $planta, array $validated)
    {
        $relations = [
            'classificacoes',
            'nativas',
            'crescimentos',
            'floracoes',
            'frutos',
            'produtividades'
        ];

        foreach ($relations as $relation) {
            if (array_key_exists($relation, $validated)) {
                $planta->{$relation}()->sync($validated[$relation]);
            } else {
                $planta->{$relation}()->detach();
            }
        }
    }

    protected function uploadImagens(Planta $planta, array $imagens)
    {
        foreach ($imagens as $imagem) {
            $path = $imagem->store('public/plantas');
            
            ImagemPlanta::create([
                'id_planta' => $planta->id,
                'caminho' => str_replace('public/', '', $path)
            ]);
        }
    }
}