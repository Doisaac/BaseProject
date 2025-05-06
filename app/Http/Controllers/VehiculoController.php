<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;
use App\Models\Rol;
use App\Models\Permiso;
use Illuminate\Support\Facades\Gate;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Verificar si el usuario autenticado tiene permiso para leer vehículos
        if (Gate::allows('read-vehicles')) {
            $vehiculos = Vehiculo::all();
            return view('vehiculos.index', compact('vehiculos'));
        } else {
            // Mostrar un mensaje de error
            return response()->json(['error' => 'No tienes permiso para acceder a esta ruta'], 403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Verificar si el usuario autenticado tiene permiso para crear vehículos
        if (Gate::allows('create-vehicles')) {
            return view('vehiculos.create');
        } else {
            // Mostrar un mensaje de error
            //return response()->json(['error' => 'No tienes permiso para acceder a esta ruta'], 403);
            return redirect()->route('vehiculos.index')->with('error', 'No puede crear vehículos.');

        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'placa' => 'required|unique:vehiculos',
            'marca' => 'required',
            'modelo' => 'required',
            'año' => 'required|digits:4|integer',
            'estado' => 'required|in:activo,inactivo',
        ]);

        Vehiculo::create($request->all());

        return redirect()->route('vehiculos.index')->with('success', 'El vehículo ha sido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vehiculo $vehiculo)
    {
        // Verificar si el usuario autenticado tiene permiso para leer vehículos
        if (Gate::allows('read-vehicles')) {
            return view('vehiculos.show', compact('vehiculo'));
        } else {
            // Mostrar un mensaje de error
            return response()->json(['error' => 'No tienes permiso para acceder a esta ruta'], 403);

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo $vehiculo)
    {
        // Verificar si el usuario autenticado tiene permiso para actualizar vehículos con Gate
        if (Gate::allows('update-vehicles')) {
            return view('vehiculos.edit', compact('vehiculo'));
        } else {
            // Mostrar un mensaje de error
            return response()->json(['error' => 'No tienes permiso para acceder a esta ruta'], 403);

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        // Verificar si el usuario autenticado tiene permiso para actualizar vehículos con Gate
        if (Gate::allows('update-vehicles', $vehiculo)) {
            $request->validate([
                'placa' => 'required|unique:vehiculos,placa,' . $vehiculo->id,
                'marca' => 'required',
                'modelo' => 'required',
                'año' => 'required|digits:4|integer',
                'estado' => 'required|in:activo,inactivo',
            ]);
    
            $vehiculo->update($request->all());
    
            return redirect()->route('vehiculos.index')->with('success', 'El vehículo ha sido actualizado exitosamente.');
        } else {
            // Mostrar un mensaje de error
            return response()->json(['error' => 'No tienes permiso para acceder a esta ruta'], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Vehiculo $vehiculo)
    {
        // Verificar si el usuario autenticado tiene permiso para eliminar vehículos
        if (Gate::allows('delete-vehicles', $vehiculo)) {
            $vehiculo->delete();
            return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado exitosamente.');
        } else {
            // Mostrar un mensaje de error
            return redirect()->route('vehiculos.index')->with('error', 'No tiene permiso para eliminar registros.');
        }
    }
}
