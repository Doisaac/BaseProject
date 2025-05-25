@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/select2.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/select2-bootstrap-5-theme.min.css') }}" type="text/css" rel="stylesheet">
    <link href="{{ asset('css/buttons_estilo.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* 🎨 Paleta de colores */
        :root {
            --primary: #219EBC;
            --primary-light: #8ECAE8;
            --primary-dark: #023047;
            --accent: #FB8500;
            --accent-light: #FFB703;
            --success: #28a745;
            --danger: #ff4351;
            --warning: #ffc107;
            --secondary: #6c757d;
        }

        /* 🌟 Contenedor principal */
        #divcontenedor {
            opacity: 0;
            transition: all 0.6s ease;
        }
        #divcontenedor.show { opacity: 1; }

        /* 🎯 Header con gradiente púrpura */
        .content-header {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary) 100%);
            border-radius: 25px;
            margin: 20px 0 30px 0;
            padding: 50px 0;
            position: relative;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(111, 66, 193, 0.2);
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
            text-shadow: 0 3px 15px rgba(74, 44, 122, 0.4);
            position: relative;
            z-index: 1;
            text-align: center;
        }

        .content-header h1 i {
            margin-right: 15px;
            color: var(--accent-light);
            filter: drop-shadow(0 2px 8px rgba(253, 126, 20, 0.3));
        }

        /* 🚀 Botón moderno */
        .btn-group-modern {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        .btn-modern {
            border: none;
            color: white;
            padding: 18px 35px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            overflow: hidden;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            min-width: 220px;
            justify-content: center;
            background: linear-gradient(135deg, var(--success) 0%, #20c997 100%);
            box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
        }

        .btn-modern::before {
            content: '';
            position: absolute;
            top: 0; left: -100%;
            width: 100%; height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }

        .btn-modern:hover::before { left: 100%; }

        .btn-modern:hover {
            background: linear-gradient(135deg, #218838 0%, #1e7e34 100%);
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 15px 40px rgba(40, 167, 69, 0.4);
            color: white;
        }

        .btn-modern i {
            margin-right: 12px;
            font-size: 1.2rem;
        }

        /* 💎 Card principal elegante */
        .main-card {
            background: white;
            border-radius: 25px;
            box-shadow: 0 25px 50px rgba(74, 44, 122, 0.1);
            border: none;
            overflow: hidden;
            transition: all 0.4s ease;
            backdrop-filter: blur(10px);
        }

        .main-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 35px 70px rgba(74, 44, 122, 0.15);
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

        /* ✨ Modales rediseñados */
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

        /* 📝 Formularios mejorados */
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }

        .form-group label {
            color: var(--primary-dark);
            font-weight: 600;
            font-size: 1rem;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
        }

        .form-group label i {
            margin-right: 10px;
            color: var(--primary);
            width: 18px;
        }

        /* 🎯 Select2 personalizado */
        .select2-container--bootstrap-5 .select2-selection {
            border: 2px solid #e9ecef !important;
            border-radius: 15px !important;
            padding: 10px 15px !important;
            font-size: 1rem !important;
            background: #f8f9fa !important;
            transition: all 0.3s ease !important;
            min-height: 55px !important;
        }

        .select2-container--bootstrap-5.select2-container--focus .select2-selection {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 0.2rem rgba(111, 66, 193, 0.25) !important;
            background: white !important;
        }

        .select2-container--bootstrap-5 .select2-selection__rendered {
            color: var(--primary-dark) !important;
            padding-top: 8px !important;
        }

        .select2-dropdown {
            border: 2px solid var(--primary) !important;
            border-radius: 15px !important;
            box-shadow: 0 10px 30px rgba(111, 66, 193, 0.2) !important;
        }

        /* 🎯 Botones de modal */
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

        /* 🚨 Modal de borrar especial */
        .modal-delete .modal-header {
            background: linear-gradient(135deg, var(--danger) 0%, #dc3545 100%);
        }

        .modal-delete .modal-body {
            text-align: center;
            padding: 40px;
        }

        .modal-delete .modal-body p {
            font-size: 1.1rem;
            color: var(--primary-dark);
            margin-bottom: 20px;
        }

        .modal-delete .modal-body i {
            font-size: 4rem;
            color: var(--danger);
            margin-bottom: 20px;
        }

        /* 📱 Responsive */
        @media (max-width: 768px) {
            .content-header h1 { font-size: 2.2rem; }
            .btn-modern { width: 100%; max-width: 300px; }
            .main-card .card-body { padding: 25px; }
            .modal-body { padding: 25px; }
        }

        /* 🎭 Animaciones */
        @keyframes slideInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .animate-in { animation: slideInUp 0.6s ease-out; }

        /* 📊 Tabla responsive */
        table { table-layout: fixed; }
    </style>
@stop

<div id="divcontenedor" style="display: none">
    <!-- Header -->
    <section class="content-header animate-in">
        <div class="container-fluid">
            <h1><i class="fas fa-shield-alt"></i>Lista de Permisos</h1>
            
            <div class="btn-group-modern">
                <button type="button" class="btn-modern" onclick="modalAgregar()">
                    <i class="fas fa-plus-circle"></i>Agregar Permiso
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
                        <i class="fas fa-list-check">&nbsp;</i>Permisos del Rol
                    </h3>
                </div>
                <div class="card-body">
                    <div class="row">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="tablaDatatable"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Agregar Permiso -->
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
                    <form id="formulario-nuevo">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-key"></i>Seleccionar Permiso
                                    </label>
                                    <select class="form-control" id="permiso-nuevo">
                                        @foreach($permisos as $key => $value)
                                            <option value="{{ $key }}">{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary-modern" data-dismiss="modal">
                        <i class="fas fa-times me-2">&nbsp;</i>&nbsp;Cerrar
                    </button>
                    <button type="button" class="btn btn-success-modern" onclick="agregarPermiso()">
                        <i class="fas fa-save me-2">&nbsp;</i>&nbsp;Agregar Permiso
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Borrar Permiso -->
    <div class="modal fade modal-delete" id="modalBorrar">
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
                    <form id="formulario-borrar">
                        <i class="fas fa-exclamation-triangle"></i>
                        <p><strong>¿Está seguro de eliminar este permiso?</strong></p>
                        <p>Esta acción quitará el permiso del rol seleccionado.</p>
                        <p class="text-warning"><strong>El usuario perderá acceso a esta funcionalidad.</strong></p>
                        <input type="hidden" id="idborrar">
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary-modern" data-dismiss="modal">
                        <i class="fas fa-times me-2">&nbsp;</i>&nbsp;Cancelar
                    </button>
                    <button type="button" class="btn btn-danger-modern" onclick="borrar()">
                        <i class="fas fa-trash-alt me-2">&nbsp;</i>&nbsp;Eliminar
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
<script src="{{ asset('js/select2.min.js') }}"></script>

<script>
    $(document).ready(function(){
        // 🎨 Configurar toastr
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };

        // 🎯 Configurar Select2
        $('#permiso-nuevo').select2({
            theme: "bootstrap-5",
            placeholder: "Seleccione un permiso...",
            allowClear: true,
            language: {
                noResults: function(){
                    return "No se encontraron permisos";
                },
                searching: function() {
                    return "Buscando...";
                }
            }
        });

        // 📊 Cargar tabla con el ID del rol
        var id = {{ $id }};
        var ruta = "{{ url('/admin/roles/permisos/tabla') }}/" + id;
        $('#tablaDatatable').load(ruta, function() {
            document.getElementById("divcontenedor").style.display = "block";
            setTimeout(() => {
                document.getElementById("divcontenedor").classList.add("show");
            }, 100);
        });
    });

    // Modal borrar permiso
    function modalBorrar(id){
        $('#idborrar').val(id);
        $('#modalBorrar').modal('show');
    }

    // Borrar permiso
    function borrar(){
        openLoading();
        
        var idpermiso = document.getElementById('idborrar').value;
        var idrol = {{ $id }};
        var formData = new FormData();
        formData.append('idpermiso', idpermiso);
        formData.append('idrol', idrol);

        axios.post(url+'/roles/permiso/borrar', formData)
            .then((response) => {
                closeLoading();
                $('#modalBorrar').modal('hide');
                
                if(response.data.success === 1){
                    toastr.success('Permiso eliminado correctamente');
                    recargar();
                }else{
                    toastr.error('Error al eliminar el permiso');
                }
            })
            .catch(() => {
                closeLoading();
                toastr.error('Error al eliminar el permiso');
            });
    }

    // Modal agregar
    function modalAgregar(){
        document.getElementById("formulario-nuevo").reset();
        $('#permiso-nuevo').val(null).trigger('change');
        $('#modalAgregar').modal('show');
        setTimeout(() => $('#permiso-nuevo').select2('open'), 500);
    }

    // Agregar permiso
    function agregarPermiso(){
        var idpermiso = document.getElementById('permiso-nuevo').value;
        
        if(!idpermiso || idpermiso === ''){
            toastr.error('Debe seleccionar un permiso');
            return;
        }

        openLoading();
        
        var idrol = {{ $id }};
        var formData = new FormData();
        formData.append('idpermiso', idpermiso);
        formData.append('idrol', idrol);

        axios.post(url+'/roles/permiso/agregar', formData)
            .then((response) => {
                closeLoading();
                $('#modalAgregar').modal('hide');
                
                if(response.data.success === 1){
                    toastr.success('Permiso agregado correctamente');
                    recargar();
                }else if(response.data.success === 2){
                    toastr.warning('Este permiso ya está asignado al rol');
                }else{
                    toastr.error('Error al agregar el permiso');
                }
            })
            .catch(() => {
                closeLoading();
                toastr.error('Error al agregar el permiso');
            });
    }

    // Recargar tabla
    function recargar(){
        var id = {{ $id }};
        var ruta = "{{ url('/admin/roles/permisos/tabla') }}/" + id;
        $('#tablaDatatable').load(ruta);
    }

    // Atajos de teclado
    document.addEventListener('keydown', function(event) {
        // ESC para cerrar modales
        if (event.key === 'Escape') {
            $('#modalAgregar').modal('hide');
            $('#modalBorrar').modal('hide');
        }
        
        // Ctrl + N para nuevo permiso
        if (event.ctrlKey && event.key === 'n') {
            event.preventDefault();
            modalAgregar();
        }
    });

    // Mejorar experiencia del Select2
    $('#modalAgregar').on('shown.bs.modal', function () {
        $('#permiso-nuevo').select2('focus');
    });

    // Limpiar select2 al cerrar modal
    $('#modalAgregar').on('hidden.bs.modal', function () {
        $('#permiso-nuevo').val(null).trigger('change');
    });
</script>

@stop
