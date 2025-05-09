<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;
use App\Models\Libro;
use App\Models\User;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class PrestamoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuario = request()->attributes->get('usuario');
        $rol = request()->attributes->get('rol');
        
        $prestamos = ($rol === 'administrador') 
            ? Prestamo::with(['lector', 'libros'])->get()
            : Prestamo::where('lector_id', $usuario['id'])->with('libros')->get();

        return response()->json($prestamos);
    }

    public function store(Request $request)
    {
        $rol = $request->attributes->get('rol');
        
        if ($rol != 'administrador') {
            return response()->json(['mensaje' => 'Se requiere rol de administrador'], 403);
        }

        $request->validate([
            'fecha' => 'required|date',
            'lectorId' => 'required|exists:users,id',
            'libros' => 'required|array',
            'libros.*' => 'exists:libros,id'
        ]);

        $prestamo = Prestamo::create([
            'fecha' => $request->fecha,
            'lector_id' => $request->lectorId,
            'fecha_devolucion' => $request->fechaDevolucion
        ]);

        $prestamo->libros()->attach($request->libros);

        return response()->json($prestamo->load('libros'), 201);
    }

    public function update(Request $request, $id)
    {
        $rol = $request->attributes->get('rol');
        
        if ($rol != 'administrador') {
            return response()->json(['mensaje' => 'Se requiere rol de administrador'], 403);
        }

        $prestamo = Prestamo::findOrFail($id);

        $request->validate([
            'fecha_devolucion' => 'required|date',
            'libros' => 'sometimes|array',
            'libros.*' => 'exists:libros,id'
        ]);

        $prestamo->update($request->only('fecha_devolucion'));

        if ($request->has('libros')) {
            $prestamo->libros()->sync($request->libros);
        }

        return response()->json($prestamo->fresh()->load('libros'));
    }

    public function destroy($id)
    {
        $rol = request()->attributes->get('rol');
        
        if ($rol != 'administrador') {
            return response()->json(['mensaje' => 'Se requiere rol de administrador'], 403);
        }

        $prestamo = Prestamo::findOrFail($id);
        $prestamo->delete();
        
        return response()->json(null, 204);
    }

    public function misPrestamos()
    {
        $usuario = request()->attributes->get('usuario');
        $rol = request()->attributes->get('rol');
        
        $prestamos = ($rol === 'usuario') 
            ? Prestamo::with(['lector', 'libros'])->get()
            : Prestamo::where('lector_id', $usuario['id'])->with('libros')->get();

        return response()->json($prestamos);
    }
}
