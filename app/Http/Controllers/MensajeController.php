<?php

namespace App\Http\Controllers;

use App\Models\Mensaje;
use App\Models\Publicacion;
use Illuminate\Http\Request;

class MensajeController extends Controller
{
    public function store(Request $request, Publicacion $publicacion)
    {
        $request->validate([
            'contenido' => ['required', 'string', 'max:1000'],
        ]);

        if ($request->user()->id === $publicacion->user_id) {
            return back()->withErrors(['contenido' => 'No puedes contactarte a ti mismo sobre tu propia publicación.']);
        }

        Mensaje::create([
            'publicacion_id' => $publicacion->id,
            'emisor_id' => $request->user()->id,
            'receptor_id' => $publicacion->user_id,
            'contenido' => $request->contenido,
        ]);

        return back()->with('status', 'Mensaje enviado.');
    }
}
