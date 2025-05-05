<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehiculos = Vehiculo::all();
        return view('vehiculos.index', compact('vehiculos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('vehiculos.create');
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
        return view('vehiculos.show', compact('vehiculo'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehiculo $vehiculo)
    {
        return view('vehiculos.edit', compact('vehiculo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehiculo $vehiculo)
    {
        $request->validate([
            'placa' => 'required|unique:vehiculos,placa,' . $vehiculo->id,
            'marca' => 'required',
            'modelo' => 'required',
            'año' => 'required|digits:4|integer',
            'estado' => 'required|in:activo,inactivo',
        ]);

        $vehiculo->update($request->all());

        return redirect()->route('vehiculos.index')->with('success', 'El vehículo ha sido actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehiculo $vehiculo)
    {
        $vehiculo->delete();
        return redirect()->route('vehiculos.index')->with('success', 'Vehículo eliminado exitosamente.');
    }
}
