<?php

namespace App\Http\Controllers;

use App\Models\Libro;
use Illuminate\Http\Request;

class LibroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $libros = Libro::all();
        return response()->json($libros);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $input = $request->all();
        $libro = Libro::create($input);
        return response()->json($libro, 201);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Libro $libro)
    {  
        return response()->json($libro);
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Libro $libro)
    {
        $input = $request->all();
        $libro->update($input);
        return response()->json($libro, 200);
        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Libro $libro)
    {
        
        $libro->delete();
        return response()->json($libro, 204);
    }
}
