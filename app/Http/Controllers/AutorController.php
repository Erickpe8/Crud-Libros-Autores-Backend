<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Autor;

class AutorController extends Controller
{

    //Llama a todos los autores y los relaciona con los libros
public function index()
{
    return Autor::with('libros')->get();
}

    //Quien se encarga de crear un nuevo autor
public function store(Request $request)
{
    //Valida los datos ingresados por el usuario
    $request->validate([
        'nombre' => 'required|string|max:255',
        'apellido' => 'required|string|max:255',
    ]);

    //Crea un nuevo autor en la base de datos
    $autor = Autor::create([
        'nombre' => $request->nombre,
        'apellido' => $request->apellido,
    ]);

    //Retorna el autor creado con un código de estado 201 (El codigo 201 indica que fue creado correctamente)
    return response()->json($autor, 201);
}

public function show(Autor $autor)
{
    return $autor->load('libros');
}

    //Actualiza un autor existente
public function update(Request $request, $id)
{    
    // Busca el autor por su ID. Si no existe, lanza una código 404 (Not Found).
    $autor = Autor::findOrFail($id);

    // Actualiza los datos del autor con toda la información enviada en la solicitud.
    $autor->update($request->all());

    // Retorna el autor actualizado con un código de estado 200 (OK).
    return response()->json($autor, 200);
}

    //Elimina un autor existente
public function destroy($id)
{
    // Busca el autor por su ID. Si no existe, lanza una código 404 (Not Found).
    $autor = Autor::find($id);
    if (!$autor) {
        return response()->json(['message' => 'Autor no encontrado'], 404);
    }

    // Elimina el autor de la base de datos.
    $autor->delete();
    return response()->noContent(); 
}

}