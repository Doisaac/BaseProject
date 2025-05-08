@extends('layouts.app')

@section('title', 'Editar Vehículo')

@section('content')
    <h2>Editar Vehículo</h2>

    <form id="formVehiculo" action="{{ route('vehiculos.update', $vehiculo->id) }}" method="POST" novalidate>
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="placa" class="form-label">Placa</label>
            <input type="text" name="placa" class="form-control @error('placa') is-invalid @enderror" value="{{ old('placa', $vehiculo->placa) }}">
            @error('placa')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" name="marca" class="form-control @error('marca') is-invalid @enderror" value="{{ old('marca', $vehiculo->marca) }}">
            @error('marca')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" name="modelo" class="form-control @error('modelo') is-invalid @enderror" value="{{ old('modelo', $vehiculo->modelo) }}">
            @error('modelo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="año" class="form-label">Año</label>
            <input type="number" name="año" class="form-control @error('año') is-invalid @enderror" value="{{ old('año', $vehiculo->año) }}">
            @error('año')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" class="form-control @error('estado') is-invalid @enderror">
                <option value="activo" {{ old($vehiculo->estado) == 'activo' ? 'selected' : '' }}>Activo</option>
                <option value="inactivo" {{ old($vehiculo->estado) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
            </select>
            @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Actualizar</button>
        <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection

@vite(['resources/js/app.js']) 