@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/theme.css') }}">
<script src="{{ asset('js/theme.js') }}" defer></script>

@section('title', 'Crear Vehículo')

@section('content')
    <h2>Crear Vehículo</h2>

    <form id="formVehiculo"  action="{{ route('vehiculos.store') }}" method="POST" novalidate>
        @csrf

        <div class="mb-3">
            <label for="placa" class="form-label">Placa</label>
            <input type="text" name="placa" class="form-control @error('placa') is-invalid @enderror" value="{{ old('placa') }}">
            @error('placa')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" name="marca" class="form-control @error('marca') is-invalid @enderror" value="{{ old('marca') }}">
            @error('marca')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" name="modelo" class="form-control @error('modelo') is-invalid @enderror" value="{{ old('modelo') }}">
            @error('modelo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="año" class="form-label">Año</label>
            <input type="number" name="año" class="form-control @error('año') is-invalid @enderror" value="{{ old('año') }}">
            @error('año')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select name="estado" class="form-control @error('estado') is-invalid @enderror">
                <option value="" disabled selected hidden>Selecciona una opción</option>
                <option value="activo" >Activo</option>
                <option value="inactivo" >Inactivo</option>
            </select>
            @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Guardar</button>
        <a href="{{ route('vehiculos.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
    <script src="{{ asset('js/vehiculo-form.js') }}"></script>
    
@endsection


@vite(['resources/js/app.js']) 