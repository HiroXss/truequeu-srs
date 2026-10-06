<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Publicacion;
use Illuminate\Http\Request;

class PublicacionController extends Controller
{
    public function index(Request $request)
    {
        $query = Publicacion::with(['user', 'categoria'])
            ->where('estado', '!=', 'intercambiado');

        if ($request->filled('q')) {
            $q = $request->string('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('titulo', 'like', "%{$q}%")
                    ->orWhere('descripcion', 'like', "%{$q}%")
                    ->orWhere('ofrece', 'like', "%{$q}%")
                    ->orWhere('busca', 'like', "%{$q}%");
            });
        }

        if ($request->filled('categoria_id')) {
            $query->where('categoria_id', $request->integer('categoria_id'));
        }

        if ($request->filled('estado') && in_array($request->estado, ['disponible', 'reservado'])) {
            $query->where('estado', $request->estado);
        }

        $publicaciones = $query->latest()->paginate(9)->withQueryString();
        $categorias = Categoria::orderBy('nombre')->get();

        return view('publicaciones.index', compact('publicaciones', 'categorias'));
    }

    public function show(string $id)
    {
        $publicacion = Publicacion::with(['user', 'categoria', 'mensajes.emisor', 'mensajes.receptor'])->findOrFail($id);

        $esDueno = auth()->check() && auth()->id() === $publicacion->user_id;

        $historial = auth()->check()
            ? $publicacion->mensajes()
                ->where(function ($q) {
                    $q->where('emisor_id', auth()->id())->orWhere('receptor_id', auth()->id());
                })
                ->oldest()
                ->get()
            : collect();

        return view('publicaciones.show', compact('publicacion', 'esDueno', 'historial'));
    }
}
