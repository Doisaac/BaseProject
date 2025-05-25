@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/buttons_estilo.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /*  Paleta de colores */
        :root {
            --primary: #219EBC;
            --primary-light: #8ECAE8;
            --primary-dark: #023047;
            --accent: #FB8500;
            --accent-light: #FFB703;
            --success: #28a745;
            --danger: #ff4351;
        }

        /*  Contenedor principal */
        #divcontenedor {
            opacity: 0;
            transition: all 0.6s ease;
        }
        #divcontenedor.show { opacity: 1; }

        /*  Header con gradiente */
        .content-header {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
            border-radius: 25px;
            margin: 20px 0 30px 0;
            padding: 50px 0;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(33, 158, 188, 0.2);
        }

        .content-header::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: radial-gradient(circle at 30% 20%, rgba(255,255,255,0.2) 0%, transparent 50%);
        }

        .content-header h1 {
            color: white;
            font-weight: 700;
            font-size: 2.8rem;
            margin: 0;
            text-shadow: 0 3px 15px rgba(2, 48, 71, 0.4);
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .content-header h1 i {
            margin-right: 15px;
            color: var(--accent-light);
            filter: drop-shadow(0 2px 8px rgba(251, 133, 0, 0.3));
        }

        /*  Botón agregar moderno */
        .btn-add {
            background: linear-gradient(135deg, var(--success) 0%, #20c997 100%);
            border: none;
            color: white;
            padding: 18px 35px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
        }

        .btn-add::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-add:hover::before { left: 100%; }

        .btn-add:hover {
            background: linear-gradient(135deg, #218838 0%, #1e7e34 100%);
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 40px rgba(40, 167, 69, 0.4);
            color: white;
        }

        .btn-add i {
            margin-right: 12px;
            font-size: 1.2rem;
        }

        /* Card principal elegante */
        .main-card {
            background: white;
            border-radius: 25px;
            box-shadow: 0 25px 50px rgba(2, 48, 71, 0.1);
            border: none;
            overflow: hidden;
            transition: all 0.4s ease;
            backdrop-filter: blur(10px);
        }

        .main-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 35px 70px rgba(2, 48, 71, 0.15);
        }

        .main-card .card-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            padding: 30px;
            position: relative;
        }

        .main-card .card-header::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--accent) 0%, var(--accent-light) 100%);
        }

        .main-card .card-title {
            font-size: 1.6rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .main-card .card-title i {
            margin-right: 15px;
            font-size: 1.4rem;
            color: var(--accent-light);
        }

        .main-card .card-body {
            padding: 35px;
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
        }

        /*  Modales rediseñados */
        .modal-content {
            border-radius: 25px;
            border: none;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .modal-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            padding: 30px;
            position: relative;
        }

        .modal-header::after {
            content: '';
            position: absolute;
            bottom: 0; left: 0; right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent) 0%, var(--accent-light) 100%);
        }

        .modal-title {
            font-weight: 600;
            font-size: 1.4rem;
            display: flex;
            align-items: center;
        }

        .modal-title i {
            margin-right: 12px;
            font-size: 1.3rem;
            color: var(--accent-light);
        }

        .modal-header .close {
            color: white;
            opacity: 0.8;
            font-size: 1.8rem;
            text-shadow: none;
            transition: all 0.3s ease;
        }

        .modal-header .close:hover {
            opacity: 1;
            transform: scale(1.1);
        }

        .modal-body {
            padding: 35px;
            background: linear-gradient(145deg, #ffffff 0%, #f8f9fa 100%);
        }

        .modal-footer {
            padding: 25px 35px;
            border: none;
            background: #f8f9fa;
        }

        /*  Formularios mejorados */
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            color: var(--primary-dark);
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
        }

        .form-group label i {
            margin-right: 10px;
            color: var(--primary);
            width: 18px;
        }

        .form-control {
            border: 2px solid #e9ecef;
            border-radius: 15px;
            padding: 18px 25px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 0.2rem rgba(33, 158, 188, 0.25);
            background: white;
            transform: translateY(-2px);
        }

        /* Botones de modal */
        .btn-success-modern {
            background: linear-gradient(135deg, var(--success) 0%, #20c997 100%);
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
        }

        .btn-success-modern:hover {
            background: linear-gradient(135deg, #218838 0%, #1e7e34 100%);
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(40, 167, 69, 0.4);
            color: white;
        }

        .btn-danger-modern {
            background: linear-gradient(135deg, var(--danger) 0%, #dc3545 100%);
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(255, 67, 81, 0.3);
        }

        .btn-danger-modern:hover {
            background: linear-gradient(135deg, #c82333 0%, #bd2130 100%);
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(255, 67, 81, 0.4);
            color: white;
        }

        .btn-secondary-modern {
            background: #6c757d;
            border: none;
            color: white;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-secondary-modern:hover {
            background: #5a6268;
            transform: translateY(-2px);
            color: white;
        }

        /*  Alertas mejoradas */
        .alert {
            border-radius: 15px;
            padding: 20px 25px;
            border: none;
            font-weight: 500;
        }

        .alert-info {
            background: linear-gradient(135deg, rgba(142, 202, 232, 0.2) 0%, rgba(33, 158, 188, 0.1) 100%);
            color: var(--primary-dark);
            border-left: 4px solid var(--primary);
        }

        .alert-warning {
            background: linear-gradient(135deg, rgba(255, 183, 3, 0.2) 0%, rgba(251, 133, 0, 0.1) 100%);
            color: var(--primary-dark);
            border-left: 4px solid var(--accent);
        }

        /*  Responsive */
        @media (max-width: 768px) {
            .content-header h1 { font-size: 2.2rem; }
            .btn-add { width: 100%; margin: 20px 0; }
            .main-card .card-body { padding: 25px; }
            .modal-body { padding: 25px; }
        }

        /*  Animaciones */
        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-in { animation: slideInUp 0.6s ease-out; }
    </style>
@stop

<div id="divcontenedor" style="display: none">
    <!--  Header elegante -->
    <section class="content-header animate-in">
        <div class="container-fluid">
            <h1><i class="fas fa-shield-alt"></i>Gestión de Permisos</h1>
            <div class="text-center mt-4">
                <button type="button" class="btn-add" onclick="modalAgregar()">
                    <i class="fas fa-plus"></i>Agregar Permiso
                </button>
            </div>
        </div>
    </section>

    <!-- Card principal -->
    <section class="content">
        <div class="container-fluid">
            <div class="main-card animate-in">
                <div class="card-header">
                    <h3>
                        <i class="fas fa-list"></i>&nbsp; Lista de Permisos
                    </h3>
                </div>
                <div class="card-body">
                    <div id="tablaDatatable"></div>
                </div>
            </div>
        </div>
    </section>

    <!--  Modal Agragar -->
    <div class="modal fade" id="modalAgregar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="fas fa-plus-circle"></i>Nuevo Permiso
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        <strong>Información:</strong> Esta acción agregará el permiso al sistema.
                    </div>

                    <form id="formulario-nuevo">
                        <div class="form-group">
                            <label for="nombre-nuevo">
                                <i class="fas fa-tag"></i>Nombre del Permiso
                            </label>
                            <input type="text" 
                                maxlength="200" 
                                class="form-control" 
                                id="nombre-nuevo" 
                                placeholder="Ingrese el nombre del permiso">
                        </div>

                        <div class="form-group">
                            <label for="descripcion-nuevo">
                                <i class="fas fa-align-left"></i>Descripción
                            </label>
                            <input type="text" 
                                maxlength="200" 
                                class="form-control" 
                                id="descripcion-nuevo" 
                                placeholder="Ingrese la descripción del permiso">
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary-modern" data-dismiss="modal">
                        <i class="fas fa-times me-2"></i>&nbsp; Cerrar
                    </button>
                    <button type="button" class="btn btn-success-modern" onclick="agregarPermiso()">
                        <i class="fas fa-plus me-2"></i>&nbsp; Agregar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!--  Modal Borrar -->
    <div class="modal fade" id="modalBorrar">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="fas fa-trash-alt"></i>Eliminar Permiso
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>¡Atención!</strong> Esta acción eliminará el permiso de todos los roles.
                    </div>

                    <div class="text-center py-4">
                        <i class="fas fa-trash-alt text-danger" style="font-size: 4rem; opacity: 0.7;"></i>
                        <h5 class="mt-3 text-danger">¿Confirmar eliminación?</h5>
                        <p class="text-muted">Esta acción no se puede deshacer.</p>
                    </div>

                    <form id="formulario-borrar">
                        <input type="hidden" id="idborrar">
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary-modern" data-dismiss="modal">
                        <i class="fas fa-times me-2"></i>&nbsp; Cancelar
                    </button>
                    <button type="button" class="btn btn-danger-modern" onclick="borrar()">
                        <i class="fas fa-trash me-2"></i>&nbsp; Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@extends('backend.menus.footerjs')
@section('archivos-js')

<script src="{{ asset('js/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ asset('js/toastr.min.js') }}"></script>
<script src="{{ asset('js/axios.min.js') }}"></script>
<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
<script src="{{ asset('js/alertaPersonalizada.js') }}"></script>

<script>
    $(document).ready(function(){
        // Configurar toastr con estilo
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };

        //  Cargar tabla
        var ruta = "{{ url('/admin/roles/permisos-todos/tabla') }}";
        $('#tablaDatatable').load(ruta, function() {
            document.getElementById("divcontenedor").style.display = "block";
            setTimeout(() => {
                document.getElementById("divcontenedor").classList.add("show");
            }, 100);
        });
    });

    // Modal agregar
    function modalAgregar(){
        document.getElementById("formulario-nuevo").reset();
        $('#modalAgregar').modal('show');
        setTimeout(() => document.getElementById('nombre-nuevo').focus(), 500);
    }

    //  Agregar permiso
    function agregarPermiso(){
        var nombre = document.getElementById('nombre-nuevo').value.trim();
        var descripcion = document.getElementById('descripcion-nuevo').value.trim();

        if(nombre === ''){
            toastr.error('El nombre es requerido');
            return;
        }

        if(nombre.length > 200){
            toastr.error('Máximo 200 caracteres para el nombre');
            return;
        }

        if(descripcion === ''){
            toastr.error('La descripción es requerida');
            return;
        }

        if(descripcion.length > 200){
            toastr.error('Máximo 200 caracteres para la descripción');
            return;
        }

        openLoading();

        var formData = new FormData();
        formData.append('nombre', nombre);
        formData.append('descripcion', descripcion);

        axios.post(url+'/permisos/extra-nuevo', formData)
            .then((response) => {
                closeLoading();
                $('#modalAgregar').modal('hide');

                if(response.data.success === 1){
                    alertaMensaje('warning', 'Nombre Repetido', 'Cambiar el nombre del Permiso');
                }
                else if(response.data.success === 2){
                    toastr.success('Permiso agregado correctamente');
                    recargar();
                }
                else{
                    toastr.error('Error al agregar');
                }
            })
            .catch(() => {
                closeLoading();
                toastr.error('Error al agregar');
            });
    }

    //  Modal borrar
    function modalBorrar(id){
        $('#idborrar').val(id);
        $('#modalBorrar').modal('show');
    }

    //  Borrar permiso
    function borrar(){
        openLoading();
        
        var idpermiso = document.getElementById('idborrar').value;
        var formData = new FormData();
        formData.append('idpermiso', idpermiso);

        axios.post(url+'/permisos/extra-borrar', formData)
            .then((response) => {
                closeLoading();
                $('#modalBorrar').modal('hide');

                if(response.data.success === 1){
                    toastr.success('Permiso eliminado correctamente');
                    recargar();
                }else{
                    toastr.error('Error al eliminar');
                }
            })
            .catch(() => {
                closeLoading();
                toastr.error('Error al eliminar');
            });
    }

    //  Recargar tabla
    function recargar(){
        var ruta = "{{ url('/admin/roles/permisos-todos/tabla') }}";
        $('#tablaDatatable').load(ruta);
    }

    //  Cerrar modales con ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            $('#modalAgregar').modal('hide');
            $('#modalBorrar').modal('hide');
        }
    });
</script>

@stop