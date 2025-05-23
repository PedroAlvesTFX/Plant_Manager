<?php

namespace App\Http\Controllers;

use App\Models\Planta;
use App\Models\Foto;
use Illuminate\Http\Request;
use SimpleSoftwareIO\SimpleQRCode\Facades\QRCode;
use Illuminate\Support\Facades\Storage;

class PlantController extends Controller
{
    public function index()
    {
        return view('planta.index', ['plantas' => Planta::all()]);
    }

    public function list()
    {
        return view('planta.index', ['plantas' => Planta::all()]);
    }

    public function store(Request $request)
    {
        $Plant = Planta::create($request->only(['nome_popular', 'nome_cientifico', 'e_apicola','e_panc','e_forrageira']));
        return redirect('/admin/planta');
    }

    public function show($id)
    {
#        $Plant = Plant::findOrFail($id);
#        return view('Plant.upload', compact('Plant'));
        return redirect('teste.php');
    }



    public function uploadFoto(Request $request, $id)
    {
        $request->validate([
            'foto' => 'required|image',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        $Plant = Plant::findOrFail($id);
        $path = $request->file('foto')->store('public/fotos');

        $Plant->fotos()->create([
            'caminho' => $path,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
        ]);

        return back()->with('success', 'Foto enviada com sucesso!');
    }

/*id | id_rel_img | nome_popular | nome_cientifico | 
id_rel_classificacao | id_rel_nativa | e_apicola | e_panc | e_forrageira | id_rel_produtividade | id_rel_crescimento | id_rel_floracao | id_rel_fruto | 
cor_fruto | cor_flor | cor_folha | data
*/
public function edit($id)
{
    $planta = Planta::findOrFail($id);
    return view('planta.edit', compact('planta'));
}


public function update(Request $request, $id)
{
    $request->validate([
        'nome_popular' => 'required|string|max:255',
        'nome_cientifico' => 'nullable|string',
        'e_apicola' => 'nullable|string',
        'e_forrageira' => 'nullable|string',
        'e_panc' => 'nullable|string',
    ]);

    $planta = Planta::findOrFail($id);
    $planta->nome_popular    = $request->nome_popular;
    $planta->nome_cientifico = $request->nome_cientifico;
    $planta->e_apicola       = $request->e_apicola;
    $planta->e_forrageira    = $request->e_forrageira;
    $planta->e_panc    = $request->e_panc;
    $planta->save();
    return view('planta.edit', compact('planta'));

#    return redirect()->route('planta.edit', $planta->id)->with('success', 'Planta atualizada com sucesso!');
}



    public function destroy($id)
    {
        // Encontrar a planta pelo ID
        $planta = Planta::findOrFail($id);

        // Verificar se a planta existe
        if ($planta) {
            // Deletar a planta
            $planta->delete();

            // Redirecionar com uma mensagem de sucesso
            return redirect()->route('plantas.show')->with('success', 'Planta deletada com sucesso!');
        //    return view('planta.index', compact('planta'));

        }

        // Se a planta não existir, redirecionar com erro
        return redirect()->route('planta.show')->with('error', 'Planta não encontrada.');
    }


public function buscar(Request $request)
{
    $busca = $request->input('busca');

    $plantas = Planta::when($busca, function ($query, $busca) {
        return $query->where('nome_popular', 'ILIKE', "%{$busca}%");
    })
    ->orderBy('id', 'desc')
    ->take(10)
    ->get();

    // Retorna apenas o HTML da tabela para ser inserido via JS
    return view('planta.tabela', compact('plantas'));
}











}