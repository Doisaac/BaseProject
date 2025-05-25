@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/responsive.bootstrap4.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/buttons.bootstrap4.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/estiloToggle.css') }}" type="text/css" rel="stylesheet" />
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
        }

        /* 🌟 Contenedor principal */
        #divcontenedor {
            opacity: 0;
            transition: all 0.6s ease;
        }
        #divcontenedor.show { opacity: 1; }

        /* 🎯 Header con gradiente */
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

        /* 🚀 Botón agregar moderno */
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

        /* Formularios mejorados */
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

        /* 🔘 Toggle switch mejorado */
        .switch {
            position: relative;
            display: inline-block;
            width: 150px;
            height: 40px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, #ccc 0%, #999 100%);
            transition: all 0.4s;
            border-radius: 40px;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 32px;
            width: 32px;
            left: 4px;
            bottom: 4px;
            background: white;
            transition: all 0.4s;
            border-radius: 50%;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        input:checked + .slider {
            background: linear-gradient(135deg, var(--success) 0%, #20c997 100%);
        }

        input:checked + .slider:before {
            transform: translateX(110px);
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

        /* 📱 Responsive */
        @media (max-width: 768px) {
            .content-header h1 { font-size: 2.2rem; }
            .btn-add { width: 100%; margin: 20px 0; }
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
    <!--  Header -->
    <section class="content-header animate-in">
        <div class="container-fluid">
            <h1><i class="fas fa-users-cog"></i>Permisos de Usuarios</h1>
            <div class="text-center mt-4">
                <button type="button" class="btn-add" onclick="modalAgregar()">
                    <i class="fas fa-user-plus"></i>Nuevo Usuario
                </button>
            </div>
        </div>
    </section>

    <!--Card principal -->
    <section class="content">
        <div class="container-fluid">
            <div class="main-card animate-in">
                <div class="card-header">
                    <h3>
                        <i class="fas fa-list-ul">&nbsp;</i>Lista de Usuarios
                    </h3>
                </div>
                <div class="card-body">
                    <div id="tablaDatatable"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal Agregar Usuario -->
    <div class="modal fade" id="modalAgregar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="fas fa-user-plus"></i>Nuevo Usuario
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formulario-nuevo">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-user"></i>Nombre
                                    </label>
                                    <input type="text" 
                                        maxlength="50" 
                                        autocomplete="off" 
                                        class="form-control" 
                                        id="nombre-nuevo" 
                                        placeholder="Ingrese el nombre completo">
                                </div>

                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-at"></i>Usuario
                                    </label>
                                    <input type="text" 
                                           maxlength="50" 
                                           autocomplete="off" 
                                           class="form-control" 
                                           id="usuario-nuevo" 
                                           placeholder="Nombre de usuario">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-lock"></i>Contraseña
                                    </label>
                                    <input type="password" 
                                           maxlength="16" 
                                           autocomplete="off" 
                                           class="form-control" 
                                           id="password-nuevo" 
                                           placeholder="Contraseña segura">
                                </div>

                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-user-tag"></i>Rol
                                    </label>
                                    <select class="form-control" id="rol-nuevo">
                                        @foreach($roles as $key => $value)
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
                        <i class="fas fa-times me-2"></i>&nbsp;&nbsp;Cerrar
                    </button>
                    <button type="button" class="btn btn-success-modern" onclick="nuevoUsuario()">
                        <i class="fas fa-save me-2"></i>&nbsp;&nbsp;Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Editar Usuario -->
    <div class="modal fade" id="modalEditar">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">
                        <i class="fas fa-user-edit"></i>Editar Usuario
                    </h4>
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="formulario-editar">
                        <input type="hidden" id="id-editar">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-user-tag"></i>Rol
                                    </label>
                                    <select class="form-control" id="rol-editar">
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-user"></i>Nombre
                                    </label>
                                    <input type="text" 
                                           maxlength="50" 
                                           autocomplete="off" 
                                           class="form-control" 
                                           id="nombre-editar">
                                </div>

                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-at"></i>Usuario
                                    </label>
                                    <input type="text" 
                                           maxlength="50" 
                                           autocomplete="off" 
                                           class="form-control" 
                                           id="usuario-editar">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-lock"></i>Contraseña
                                    </label>
                                    <input type="password" 
                                           maxlength="16" 
                                           autocomplete="off" 
                                           class="form-control" 
                                           id="password-editar" 
                                           placeholder="Dejar vacío para mantener actual">
                                </div>

                                <div class="form-group">
                                    <label>
                                        <i class="fas fa-toggle-on"></i>Disponibilidad
                                    </label>
                                    <br>
                                    <label class="switch" style="margin-top:10px">
                                        <input type="checkbox" id="toggle-editar">
                                        <div class="slider round">
                                            <span class="on">Activo</span>
                                            <span class="off">Inactivo</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary-modern" data-dismiss="modal">
                        <i class="fas fa-times me-2">&nbsp;</i>&nbsp;&nbsp;Cerrar
                    </button>
                    <button type="button" class="btn btn-success-modern" onclick="actualizar()">
                        <i class="fas fa-save me-2">&nbsp;</i>&nbsp;&nbsp;Actualizar
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
<script src="{{ asset('js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('js/jszip.min.js') }}"></script>
<script src="{{ asset('js/buttons.html5.min.js') }}"></script>

<script>
    $(document).ready(function(){
        //  Configurar toastr
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000"
        };

        //  Cargar tabla
        var ruta = "{{ URL::to('admin/permisos/tabla') }}";
        $('#tablaDatatable').load(ruta, function() {
            document.getElementById("divcontenedor").style.display = "block";
            setTimeout(() => {
                document.getElementById("divcontenedor").classList.add("show");
            }, 100);
        });
    });

    //  Recargar tabla
    function recargar(){
        var ruta = "{{ url('/admin/permisos/tabla') }}";
        $('#tablaDatatable').load(ruta);
    }

    //  Modal agregar
    function modalAgregar(){
        document.getElementById("formulario-nuevo").reset();
        $('#modalAgregar').modal('show');
        setTimeout(() => document.getElementById('nombre-nuevo').focus(), 500);
    }

    //  Nuevo usuario
    function nuevoUsuario(){
        var nombre = document.getElementById('nombre-nuevo').value.trim();
        var usuario = document.getElementById('usuario-nuevo').value.trim();
        var password = document.getElementById('password-nuevo').value;
        var idrol = document.getElementById('rol-nuevo').value;

        // Validaciones
        if(nombre === ''){
            toastr.error('El nombre es requerido');
            return;
        }

        if(nombre.length > 50){
            toastr.error('Máximo 50 caracteres para el nombre');
            return;
        }

        if(usuario === ''){
            toastr.error('El usuario es requerido');
            return;
        }

        if(usuario.length > 50){
            toastr.error('Máximo 50 caracteres para el usuario');
            return;
        }

        if(password === ''){
            toastr.error('La contraseña es requerida');
            return;
        }

        if(password.length < 4){
            toastr.error('Mínimo 4 caracteres para la contraseña');
            return;
        }

        if(password.length > 16){
            toastr.error('Máximo 16 caracteres para la contraseña');
            return;
        }

        if(idrol === ''){
            toastr.error('El rol es requerido');
            return;
        }

        openLoading();

        var formData = new FormData();
        formData.append('nombre', nombre);
        formData.append('usuario', usuario);
        formData.append('password', password);
        formData.append('rol', idrol);

        axios.post(url+'/permisos/nuevo-usuario', formData)
            .then((response) => {
                closeLoading();

                if (response.data.success === 1) {
                    toastr.error('El nombre de usuario ya existe');
                }
                else if(response.data.success === 2){
                    toastr.success('Usuario agregado correctamente');
                    $('#modalAgregar').modal('hide');
                    recargar();
                }
                else {
                    toastr.error('Error al guardar el usuario');
                }
            })
            .catch(() => {
                closeLoading();
                toastr.error('Error al guardar el usuario');
            });
    }

    // Ver información del usuario
    function verInformacion(id){
        openLoading();
        document.getElementById("formulario-editar").reset();

        axios.post(url+'/permisos/info-usuario', {
            'id': id
        })
        .then((response) => {
            closeLoading();
            
            if(response.data.success === 1){
                $('#modalEditar').modal('show');
                $('#id-editar').val(response.data.info.id);
                $('#nombre-editar').val(response.data.info.nombre);
                $('#usuario-editar').val(response.data.info.usuario);

                // Limpiar y llenar select de roles
                document.getElementById("rol-editar").options.length = 0;

                $.each(response.data.roles, function(key, val){
                    if(response.data.idrol[0] == key){
                        $('#rol-editar').append('<option value="' +key +'" selected="selected">'+val+'</option>');
                    }else{
                        $('#rol-editar').append('<option value="' +key +'">'+val+'</option>');
                    }
                });

                // Configurar toggle
                if(response.data.info.activo === 0){
                    $("#toggle-editar").prop("checked", false);
                }else{
                    $("#toggle-editar").prop("checked", true);
                }
            }else{
                toastr.error('Información no encontrada');
            }
        })
        .catch(() => {
            closeLoading();
            toastr.error('Error al obtener la información');
        });
    }

    // Actualizar usuario
    function actualizar(){
        var id = document.getElementById('id-editar').value;
        var nombre = document.getElementById('nombre-editar').value.trim();
        var usuario = document.getElementById('usuario-editar').value.trim();
        var password = document.getElementById('password-editar').value;
        var idrol = document.getElementById('rol-editar').value;

        var t = document.getElementById('toggle-editar').checked;
        var toggle = t ? 1 : 0;

        // Validaciones
        if(nombre === ''){
            toastr.error('El nombre es requerido');
            return;
        }

        if(nombre.length > 50){
            toastr.error('Máximo 50 caracteres para el nombre');
            return;
        }

        if(usuario === ''){
            toastr.error('El usuario es requerido');
            return;
        }

        if(usuario.length > 50){
            toastr.error('Máximo 50 caracteres para el usuario');
            return;
        }

        if(password.length > 0){
            if(password.length < 4){
                toastr.error('Mínimo 4 caracteres para la contraseña');
                return;
            }

            if(password.length > 16){
                toastr.error('Máximo 16 caracteres para la contraseña');
                return;
            }
        }

        openLoading();

        var formData = new FormData();
        formData.append('id', id);
        formData.append('nombre', nombre);
        formData.append('usuario', usuario);
        formData.append('password', password);
        formData.append('toggle', toggle);
        formData.append('rol', idrol);

        axios.post(url+'/permisos/editar-usuario', formData)
            .then((response) => {
                closeLoading();

                if (response.data.success === 1) {
                    toastr.error('El usuario ya existe');
                }
                else if(response.data.success === 2){
                    toastr.success('Usuario actualizado correctamente');
                    $('#modalEditar').modal('hide');
                    recargar();
                }
                else {
                    toastr.error('Error al actualizar');
                }
            })
            .catch(() => {
                closeLoading();
                toastr.error('Error al actualizar');
            });
    }

    // Cerrar modales con ESC
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            $('#modalAgregar').modal('hide');
            $('#modalEditar').modal('hide');
        }
    });
</script>

@stop