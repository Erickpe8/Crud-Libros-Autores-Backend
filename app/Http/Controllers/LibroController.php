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
        'titulo' => 'required',
        'genero' => 'required',
        'autor_id' => 'required|exists:autors,id'
    ]);

    return Libro::create($request->all());
}
    public function show(Libro $libro)
    {
        return $libro->load('autor');
    }

    public function update(Request $request, $id)
    {
        $libro = Libro::findOrFail($id);
        $libro->update($request->all());
        return response()->json(['message' => 'Libro actualizado con éxito', 'libro' => $libro]);
    }


    public function destroy($id)
{
    $libro = Libro::findOrFail($id);
    $libro->delete();
    return response()->json(['message' => 'Libro eliminado']);
}

}
