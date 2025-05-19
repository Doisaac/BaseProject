@extends('layouts.app')

@section('content')
<div class="container bg-body-tertiary py-5">
    <h1 class="text-center py-2 fw-bold text-uppercase fs-3">Buscador de Imágenes</h1>

    <div class="row justify-content-center">
        <div class="col-lg-6">
            <form id="formulario">
                <div class="mb-3">
                    <label for="termino" class="form-label text-secondary fw-bold text-uppercase">Término Búsqueda</label>
                    <input
                        type="text"
                        class="form-control mt-2"
                        placeholder="Término de búsqueda. Ejemplo: Porsche 911"
                        id="termino" />
                </div>
                <div class="d-grid mt-4">
                    <input
                        type="submit"
                        value="Buscar Imágenes"
                        class="btn text-uppercase fw-bold btn btn-outline-success shadow-sm" />
                </div>
            </form>
        </div>
    </div>
</div>

<div id="resultado" class="container mt-5 d-flex flex-wrap"></div>

<div id="paginacion" class="container d-flex justify-content-center text-center flex-wrap mb-5"></div>
@endsection

@push('scripts')
@vite(['resources/js/api.js'])
@endpush