<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Autor;  

class LibroController extends Controller
{
    //Llama a todos los libros y los relaciona con los autores
    public function index()
    {
        return Libro::with('autor')->get();
    }

    //Quien se encarga de crear un nuevo libro
public function store(Request $request)
{   
    //Valida los datos ingresados por el usuario
    $request->validate([
        'titulo' => 'required',
        'genero' => 'required',
        'autor_id' => 'required|exists:autors,id'
    ]);

    //Crea un nuevo libro en la base de datos
    return Libro::create($request->all());
}

    //Retorna el libro creado con un código de estado 201 (El codigo 201 indica que fue creado correctamente)
    public function show(Libro $libro)
    {
        return $libro->load('autor');
    }

    //Actualiza un libro existente
    public function update(Request $request, $id)
    {
        $libro = Libro::findOrFail($id);
        $libro->update($request->all());
        return response()->json(['message' => 'Libro actualizado con éxito', 'libro' => $libro]);
    }

    //Elimina un libro existente
    public function destroy($id)
{
    $libro = Libro::findOrFail($id);
    $libro->delete();
    return response()->json(['message' => 'Libro eliminado']);
}

}
