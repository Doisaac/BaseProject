@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Vehículos Registrados</h2>

    <a href="{{ route('vehiculos.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Vehículo</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Placa</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Año</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
        @forelse ($vehiculos as $vehiculo)
            <tr>
                <td>{{ $vehiculo->placa }}</td>
                <td>{{ $vehiculo->marca }}</td>
                <td>{{ $vehiculo->modelo }}</td>
                <td>{{ $vehiculo->año }}</td>
                <td>{{ $vehiculo->estado }}</td>
                <td>
                    <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('vehiculos.destroy', $vehiculo->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este vehículo?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="text-center">No hay vehículos registrados.</td>
            </tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection
