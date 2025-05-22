<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Autor;



class AutorController extends Controller
{

public function index()
{
    return Autor::with('libros')->get();
}

public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
    ]);

    $autor = Autor::create([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
    ]);

    return response()->json($autor, 201);
}

public function show(Autor $autor)
{
    return $autor->load('libros');
}

public function update(Request $request, $id)
{
    $autor = Autor::findOrFail($id);
    $autor->update($request->all());

    return response()->json($autor, 200);
}
public function destroy($id)
{
    $autor = Autor::find($id);
    if (!$autor) {
        return response()->json(['message' => 'Autor no encontrado'], 404);
    }

    $autor->delete();
    return response()->noContent(); 
}

}