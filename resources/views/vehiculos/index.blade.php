@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Vehículos Registrados</h2>

    @can('create-vehicles')
        <a href="{{ route('vehiculos.create') }}" class="btn btn-primary mb-3">Agregar Nuevo Vehículo</a>
    @endcan

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
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
                @can('update-vehicles', $vehiculo)
                    <a href="{{ route('vehiculos.edit', $vehiculo->id) }}" class="btn btn-warning btn-sm">Editar</a>
                @endcan

                    <button
                        type="button"
                        class="btn btn-danger btn-sm"
                        data-bs-toggle="modal"
                        data-bs-target="#eliminarVehiculoModal"
                        data-vehiculo-id="{{ $vehiculo->id }}"
                        data-vehiculo-placa="{{ $vehiculo->placa }}"
                        data-vehiculo-marca="{{ $vehiculo->marca }}"
                        data-vehiculo-modelo="{{ $vehiculo->modelo }}">
                        Eliminar
                    </button>

                    <div class="modal fade" id="eliminarVehiculoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Eliminar Vehículo</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        ¿Estás seguro que deseas <strong>eliminar</strong> el vehículo
                                        <span id="vehiculo-marca"></span> <span id="vehiculo-modelo"></span>
                                        con placa <strong><span id="vehiculo-placa"></span></strong>?
                                    </p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <form method="POST" action="" style="display:inline-block" id="formulario-eliminar-modal">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
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

<script>
    const eliminarVehiculoModal = document.getElementById('eliminarVehiculoModal');

    if (eliminarVehiculoModal) {
        eliminarVehiculoModal.addEventListener('show.bs.modal', event => {
            const button = event.relatedTarget;

            // Extraer la información del vehículo del botón que activó el modal
            const vehiculoId = button.dataset.vehiculoId;
            const vehiculoPlaca = button.dataset.vehiculoPlaca;
            const vehiculoMarca = button.dataset.vehiculoMarca;
            const vehiculoModelo = button.dataset.vehiculoModelo;

            // Actualizar el contenido del modal
            const modalTitle = eliminarVehiculoModal.querySelector('.modal-title');
            const modalBodyParagraph = eliminarVehiculoModal.querySelector('.modal-body p');
            const modalEliminarButton = eliminarVehiculoModal.querySelector('.modal-footer button.btn-danger');

            modalBodyParagraph.innerHTML = `
                ¿Estás seguro que deseas <strong>eliminar</strong> el vehículo
                ${vehiculoMarca} ${vehiculoModelo}
                con placa <strong>${vehiculoPlaca}</strong>?
            `;

            const formularioEliminar = eliminarVehiculoModal.querySelector('form');
            formularioEliminar.action = `/vehiculos/${vehiculoId}`;
        });
    }
</script>
@endsection