@extends('layouts.app')

@section('content')
<!-- Hero Section -->
<div class="hero-section" style="background: linear-gradient(135deg, #8ECAE8 0%, #219EBC 100%); min-height: 80vh;">
    <div class="container py-5">
        <!-- Header -->
        <div class="text-center mb-5">
            <h1 class="display-4 fw-bold text-white mb-3">
                <i class="fas fa-search me-3"></i>Buscador de Imágenes
            </h1>
            <p class="lead text-white-50">Encuentra las mejores imágenes para tus proyectos</p>
        </div>

        <!-- Formulario buscador -->
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="search-card">
                    <form id="formulario" class="p-4">
                        <div class="mb-4">
                            <label for="termino" class="form-label fw-semibold mb-3" style="color: #023047; font-size: 16px;">
                                <i class="fas fa-tag me-2"></i>¿Qué estás buscando?
                            </label>
                            <div class="input-group input-group-lg">
                                <span class="input-group-text bg-white border-end-0" style="color: #219EBC;">
                                    <i class="fas fa-search"></i>
                                </span>
                                <input
                                    type="text"
                                    class="form-control border-start-0 ps-0"
                                    placeholder="Ejemplo: Porsche 911, naturaleza, tecnología..."
                                    id="termino"
                                    style="box-shadow: none; border-color: #dee2e6;" />
                            </div>
                        </div>
                        
                        <div class="d-grid">
                            <button
                                type="submit"
                                class="btn btn-search btn-lg fw-semibold text-uppercase">
                                <i class="fas fa-search me-2"></i>Buscar Imágenes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Resultados -->
<div class="results-section bg-light py-5">
    <div class="container">
        <!-- Resultados Grid -->
        <div id="resultado" class="row g-4"></div>
        
        <!-- Paginacion -->
        <div id="paginacion" class="d-flex justify-content-center mt-5"></div>
    </div>
</div>

<!-- Estilos personalizados de la sección -->
<style>
    .hero-section {
        position: relative;
        overflow: hidden;
        border-radius: 25px; /*Esquinas redondeadas, se ven mejor */
        margin: 20px;
    }

    .hero-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23ffffff" opacity="0.1"><polygon points="1000,100 1000,0 0,100"/></svg>');
        background-size: cover;
        pointer-events: none;
    }

    .search-card {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 20px;
        box-shadow: 0 20px 40px rgba(2, 48, 71, 0.1);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .search-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 25px 50px rgba(2, 48, 71, 0.15);
    }

    .btn-search {
        background: linear-gradient(135deg, #FB8500 0%, #FFB703 100%);
        border: none;
        color: white;
        padding: 15px 30px;
        border-radius: 50px;
        transition: all 0.3s ease;
        box-shadow: 0 8px 25px rgba(251, 133, 0, 0.3);
    }

    .btn-search:hover {
        background: linear-gradient(135deg, #e67700 0%, #e6a503 100%);
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(251, 133, 0, 0.4);
        color: white;
    }

    .btn-search:active {
        transform: translateY(0);
    }

    .form-control:focus {
        border-color: #219EBC;
        box-shadow: 0 0 0 0.2rem rgba(33, 158, 188, 0.25);
    }

    .input-group-text {
        border-color: #dee2e6;
    }

    /* Results Styling */
    .results-section {
        min-height: 50vh;
    }

    #resultado {
        min-height: 200px;
    }

    /* Image Cards */
    .image-card {
        background: white;
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        border: none;
    }

    .image-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .image-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        transition: transform 0.3s ease;
    }

    .image-card:hover img {
        transform: scale(1.05);
    }

    /* Pagination Styling */
    #paginacion .btn {
        margin: 0 5px;
        border-radius: 50px;
        padding: 10px 20px;
        border: 2px solid #219EBC;
        color: #219EBC;
        background: white;
        transition: all 0.3s ease;
    }

    #paginacion .btn:hover,
    #paginacion .btn.active {
        background: #219EBC;
        color: white;
        transform: translateY(-2px);
    }

    /* Loading Animation */
    .loading {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 200px;
    }

    .spinner {
        width: 50px;
        height: 50px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #219EBC;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Responsividad */
    @media (max-width: 768px) {
        .display-4 {
            font-size: 2.5rem;
        }
        
        .search-card {
            margin: 0 15px;
        }
        
        .hero-section {
            min-height: 80vh;
        }
    }

    /* Vacio */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #6c757d;
    }

    .empty-state i {
        font-size: 4rem;
        margin-bottom: 20px;
        color: #219EBC;
    }
</style>
@endsection

@push('scripts')
@vite(['resources/js/api.js'])

<!-- Icono -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<script>
// JavaScript adicional
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('formulario');
    const input = document.getElementById('termino');
    const resultado = document.getElementById('resultado');

    // Agregar efecto de loading
    function showLoading() {
        resultado.innerHTML = `
            <div class="col-12">
                <div class="loading">
                    <div class="spinner"></div>
                </div>
            </div>
        `;
    }

    // Mostrar estado vacío
    function showEmptyState() {
        resultado.innerHTML = `
            <div class="col-12">
                <div class="empty-state">
                    <i class="fas fa-images"></i>
                    <h3>No se encontraron imágenes</h3>
                    <p>Intenta con otros términos de búsqueda</p>
                </div>
            </div>
        `;
    }

    // Mejorar las tarjetas de imagen
    function createImageCard(image) {
        return `
            <div class="col-lg-3 col-md-4 col-sm-6">
                <div class="image-card">
                    <img src="${image.webformatURL}" alt="${image.tags}" loading="lazy">
                    <div class="p-3">
                        <small class="text-muted">
                            <i class="fas fa-eye me-1"></i>${image.views}
                            <i class="fas fa-heart ms-2 me-1"></i>${image.likes}
                        </small>
                    </div>
                </div>
            </div>
        `;
    }

    // Auto-focus en el input
    input.focus();

    // Placeholder animado
    const placeholders = [
        "Ejemplo: Porsche 911",
        "Ejemplo: paisajes naturales",
        "Ejemplo: tecnología moderna",
        "Ejemplo: arquitectura urbana"
    ];
    
    let placeholderIndex = 0;
    setInterval(() => {
        placeholderIndex = (placeholderIndex + 1) % placeholders.length;
        input.placeholder = placeholders[placeholderIndex];
    }, 3000);
});
</script>
@endpush