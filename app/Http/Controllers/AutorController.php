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
    $request->validate(['nombre' => 'required']);
    return Autor::create($request->all());
}

public function show(Autor $autor)
{
    return $autor->load('libros');
}

public function update(Request $request, Autor $autor)
{
    $autor->update($request->all());
    return $autor;
}

public function destroy(Autor $autor)
{
    $autor->delete();
    return response()->noContent();
}
}