<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Autor;  

class LibroController extends Controller
{
    public function index()
    {
        return Libro::with('autor')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'genero' => 'required',
            'autor_id' => 'required|exists:autors,id'
        ]);

        return Libro::create($request->all());
    }

    public function show(Libro $libro)
    {
        return $libro->load('autor');
    }

    public function update(Request $request, Libro $libro)
    {
        $libro->update($request->all());
        return $libro;
    }

    public function destroy(Libro $libro)
    {
        $libro->delete();
        return response()->noContent();
    }
}
