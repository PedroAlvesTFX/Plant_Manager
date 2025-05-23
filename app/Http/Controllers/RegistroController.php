<?php

namespace App\Http\Controllers;

use App\Models\Registro;
use App\Models\Planta;
use App\Models\Observacao;
//use App\Models\User;
use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistroController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $registros = Registro::with(['plantas', 'usuario', 'observacoes'])
            ->where('id_usuario', 'LIKE', "".auth()->id()."")
            ->orderBy('data', 'desc')
            ->paginate(10);
            
        return view('registros.index', compact('registros'));
    }

    public function create()
    {
        $plantas = Planta::orderBy('nome_popular')->get();
        return view('registros.create', compact('plantas'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_planta' => 'required|exists:plantas,id',
            'descricao' => 'required|string',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
            'tipo' => 'required|in:A,F,P', // A=Avistamento, F=Floração, P=Fruto
            'observacao' => 'nullable|string',
            'imagem_observacao' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Create registro
        $registro = Registro::create([
            'id_planta' => $validated['id_planta'],
            'id_usuario' => Auth::id(),
            'descricao' => $validated['descricao'],
            'lat' => $validated['lat'],
            'lon' => $validated['lon'],
            'tipo' => $validated['tipo']
        ]);

        // Create observação se existir
        if (!empty($validated['observacao'])) {
            $observacaoData = [
                'id_registro' => $registro->id,
                'id_usuario' => Auth::id(),
                'descricao' => $validated['observacao'],
                'lat' => $validated['lat'],
                'long' => $validated['lon']
            ];

            if ($request->hasFile('imagem_observacao')) {
                $path = $request->file('imagem_observacao')->store('public/observacoes');
                $observacaoData['imagem'] = str_replace('public/', '', $path);
            }

            $observacao = Observacao::create($observacaoData);
            
            // Link observação ao registro
            $registro->observacoes()->attach($observacao->id);
        }

        return redirect()->route('registros.show', $registro)
            ->with('success', 'Registro criado com sucesso!');
    }

    public function show(Registro $registro)
    {
        $registro->load(['plantas', 'usuario', 'observacoes.usuario']);
        return view('registros.show', compact('registro'));
    }

    public function edit(Registro $registro)
    {
        if ($registro->id_usuario != Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Acesso não autorizado');
        }

        $plantas = Planta::orderBy('nome_popular')->get();
        $registro->load(['observacoes']);
        
        return view('registros.edit', compact('registro', 'plantas'));
    }

    public function update(Request $request, Registro $registro)
    {
        if ($registro->id_usuario != Auth::id() && !Auth::user()->isAdmin()) {
            abort(403, 'Acesso não autorizado');
        }

        $validated = $request->validate([
            'id_planta' => 'required|exists:plantas,id',
            'descricao' => 'required|string',
            'lat' => 'required|numeric',
            'lon' => 'required|numeric',
            'tipo' => 'required|in:A,F,P'
        ]);

        $registro->update($validated);

        return redirect()->route('registros.show', $registro)
            ->with('success', 'Registro atualizado com sucesso!');
    }

    public function destroy(Registro $registro)
    {
        if ($registro->id_usuario != Auth::id() && !Auth::user()->is_admin()) {
            abort(403, 'Acesso não autorizado');
        }

        // Delete associated observations
        foreach ($registro->observacoes as $observacao) {
            if ($observacao->imagem) {
                Storage::delete('public/' . $observacao->imagem);
            }
            $observacao->delete();
        }

        $registro->delete();

        return redirect()->route('registros.index')
            ->with('success', 'Registro removido com sucesso!');
    }
}