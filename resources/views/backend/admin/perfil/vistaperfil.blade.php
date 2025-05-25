@extends('backend.menus.superior')

@section('content-admin-css')
    <link href="{{ asset('css/adminlte.min.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/dataTables.bootstrap4.css') }}" type="text/css" rel="stylesheet" />
    <link href="{{ asset('css/toastr.min.css') }}" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <style>
        /* Variables CSS para la paleta de colores */
        :root {
            --primary-light: #8ECAE8;
            --primary-medium: #219EBC;
            --primary-dark: #023047;
            --accent-light: #FFB703;
            --accent-dark: #FB8500;
        }

        /* Header personalizado */
        .content-header {
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-medium) 100%);
            border-radius: 0 0 25px 25px;
            margin-bottom: 30px;
            padding: 40px 0;
            position: relative;
            overflow: hidden;
        }

        .content-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1000 100" fill="%23ffffff" opacity="0.1"><polygon points="1000,100 1000,0 0,100"/></svg>');
            background-size: cover;
        }

        .content-header h1 {
            color: white;
            font-weight: 700;
            font-size: 2.5rem;
            margin: 0;
            text-shadow: 0 2px 10px rgba(2, 48, 71, 0.3);
            position: relative;
            z-index: 1;
        }

        .content-header .breadcrumb-icon {
            color: rgba(255, 255, 255, 0.8);
            font-size: 3rem;
            margin-right: 20px;
            vertical-align: middle;
        }

        /* Card principal mejorada */
        .profile-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(2, 48, 71, 0.1);
            border: none;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 50px rgba(2, 48, 71, 0.15);
        }

        .profile-card .card-header {
            background: linear-gradient(135deg, var(--primary-medium) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            padding: 25px 30px;
            position: relative;
        }

        .profile-card .card-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent-light) 0%, var(--accent-dark) 100%);
        }

        .profile-card .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
        }

        .profile-card .card-title i {
            margin-right: 12px;
            font-size: 1.3rem;
        }

        .profile-card .card-body {
            padding: 40px 30px;
        }

        /* Form groups mejorados */
        .form-group-enhanced {
            margin-bottom: 30px;
            position: relative;
        }

        .form-group-enhanced label {
            color: var(--primary-dark);
            font-weight: 600;
            font-size: 0.95rem;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .form-group-enhanced label i {
            margin-right: 8px;
            color: var(--primary-medium);
            width: 16px;
        }

        .form-control-enhanced {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 15px 20px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .form-control-enhanced:focus {
            border-color: var(--primary-medium);
            box-shadow: 0 0 0 0.2rem rgba(33, 158, 188, 0.25);
            background: white;
            transform: translateY(-2px);
        }

        .form-control-enhanced:disabled {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            color: var(--primary-dark);
            font-weight: 500;
            border-color: #dee2e6;
        }

        /* Indicador de fortaleza de contraseña */
        .password-strength {
            height: 4px;
            border-radius: 2px;
            margin-top: 8px;
            background: #e9ecef;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .password-strength-bar {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }

        .strength-weak { background: #dc3545; width: 25%; }
        .strength-fair { background: var(--accent-dark); width: 50%; }
        .strength-good { background: var(--accent-light); width: 75%; }
        .strength-strong { background: #28a745; width: 100%; }

        /* Botones mejorados */
        .btn-update {
            background: linear-gradient(135deg, var(--accent-dark) 0%, var(--accent-light) 100%);
            border: none;
            color: white;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(251, 133, 0, 0.3);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-update:hover {
            background: linear-gradient(135deg, #e67700 0%, #e6a503 100%);
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(251, 133, 0, 0.4);
            color: white;
        }

        .btn-update:active {
            transform: translateY(-1px);
        }

        .btn-update i {
            margin-right: 10px;
        }

        /* Card footer */
        .card-footer-enhanced {
            background: #f8f9fa;
            border: none;
            padding: 25px 30px;
            text-align: right;
        }

        /* Animaciones y efectos */
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Avatar placeholder */
        .user-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-light) 0%, var(--primary-medium) 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2rem;
            font-weight: bold;
            margin: 0 auto 20px;
            box-shadow: 0 8px 25px rgba(33, 158, 188, 0.3);
        }

        /* Responsivo */
        @media (max-width: 768px) {
            .content-header h1 {
                font-size: 2rem;
            }
            
            .profile-card .card-body {
                padding: 30px 20px;
            }
            
            .btn-update {
                width: 100%;
                margin-top: 10px;
            }
        }

        /* Toast personalizado */
        .toast-success {
            background-color: var(--primary-medium) !important;
        }

        .toast-error {
            background-color: #dc3545 !important;
        }
    </style>
@stop

<section class="content-header">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-12 text-center">
                <i class="fas fa-user-circle breadcrumb-icon"></i>
                <h1 class="d-inline-block">Perfil de Usuario</h1>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-10">
                <div class="profile-card fade-in">
                    <div class="card-header">
                        <h3>
                            <i class="fas fa-key"></i>
                            Actualizar Contraseña
                        </h3>
                    </div>
                    
                    <form id="profile-form">
                        <div class="card-body">
                            <!-- Avatar y usuario actual -->
                            <div class="text-center mb-4">
                                <div class="user-avatar">
                                    {{ strtoupper(substr($usuario->usuario, 0, 2)) }}
                                </div>
                                <h4 style="color: var(--primary-dark); font-weight: 600;">
                                    {{ $usuario->usuario }}
                                </h4>
                            </div>

                            <!-- Usuario actual (solo lectura) -->
                            <div class="form-group-enhanced">
                                <label for="usuario-actual">
                                    <i class="fas fa-user"></i>
                                    Usuario Actual
                                </label>
                                <input 
                                    type="text" 
                                    class="form-control form-control-enhanced" 
                                    id="usuario-actual"
                                    disabled 
                                    value="{{ $usuario->usuario }}">
                            </div>

                            <!-- Nueva contraseña -->
                            <div class="form-group-enhanced">
                                <label for="password">
                                    <i class="fas fa-lock"></i>
                                    Nueva Contraseña
                                </label>
                                <div class="position-relative">
                                    <input 
                                        type="password" 
                                        maxlength="16" 
                                        class="form-control form-control-enhanced" 
                                        id="password" 
                                        placeholder="Ingresa tu nueva contraseña">
                                    <button 
                                        type="button" 
                                        class="btn btn-link position-absolute" 
                                        style="right: 10px; top: 50%; transform: translateY(-50%); color: var(--primary-medium);"
                                        onclick="togglePassword('password')">
                                        <i class="fas fa-eye" id="password-eye"></i>
                                    </button>
                                </div>
                                <div class="password-strength">
                                    <div class="password-strength-bar" id="strength-bar"></div>
                                </div>
                                <small class="text-muted mt-1">
                                    <i class="fas fa-info-circle"></i>
                                    Entre 4 y 16 caracteres
                                </small>
                            </div>

                            <!-- Repetir contraseña -->
                            <div class="form-group-enhanced">
                                <label for="password1">
                                    <i class="fas fa-lock-open"></i>
                                    Confirmar Contraseña
                                </label>
                                <div class="position-relative">
                                    <input 
                                        type="password" 
                                        maxlength="16" 
                                        class="form-control form-control-enhanced" 
                                        id="password1" 
                                        placeholder="Confirma tu nueva contraseña">
                                    <button 
                                        type="button" 
                                        class="btn btn-link position-absolute" 
                                        style="right: 10px; top: 50%; transform: translateY(-50%); color: var(--primary-medium);"
                                        onclick="togglePassword('password1')">
                                        <i class="fas fa-eye" id="password1-eye"></i>
                                    </button>
                                </div>
                                <div id="password-match" class="mt-2"></div>
                            </div>
                        </div>

                        <div class="card-footer-enhanced">
                            <button type="button" class="btn btn-update" onclick="actualizar()">
                                <i class="fas fa-save"></i>
                                Actualizar Contraseña
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@extends('backend.menus.footerjs')

@section('archivos-js')
    <script src="{{ asset('js/jquery.dataTables.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/axios.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/alertaPersonalizada.js') }}"></script>

    <script>
        // Configurar toastr con los colores de la paleta
        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "3000",
            "extendedTimeOut": "1000"
        };

        // Función para mostrar/ocultar contraseña
        function togglePassword(fieldId) {
            const field = document.getElementById(fieldId);
            const eye = document.getElementById(fieldId + '-eye');
            
            if (field.type === 'password') {
                field.type = 'text';
                eye.classList.remove('fa-eye');
                eye.classList.add('fa-eye-slash');
            } else {
                field.type = 'password';
                eye.classList.remove('fa-eye-slash');
                eye.classList.add('fa-eye');
            }
        }

        // Verificar fortaleza de contraseña
        function checkPasswordStrength(password) {
            const strengthBar = document.getElementById('strength-bar');
            let strength = 0;
            
            if (password.length >= 4) strength++;
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            strengthBar.className = 'password-strength-bar';
            
            if (strength <= 1) {
                strengthBar.classList.add('strength-weak');
            } else if (strength <= 2) {
                strengthBar.classList.add('strength-fair');
            } else if (strength <= 3) {
                strengthBar.classList.add('strength-good');
            } else {
                strengthBar.classList.add('strength-strong');
            }
        }

        // Verificar coincidencia de contraseñas
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const password1 = document.getElementById('password1').value;
            const matchDiv = document.getElementById('password-match');
            
            if (password1.length > 0) {
                if (password === password1) {
                    matchDiv.innerHTML = '<small class="text-success"><i class="fas fa-check-circle"></i> Las contraseñas coinciden</small>';
                } else {
                    matchDiv.innerHTML = '<small class="text-danger"><i class="fas fa-times-circle"></i> Las contraseñas no coinciden</small>';
                }
            } else {
                matchDiv.innerHTML = '';
            }
        }

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            const passwordField = document.getElementById('password');
            const password1Field = document.getElementById('password1');
            
            passwordField.addEventListener('input', function() {
                checkPasswordStrength(this.value);
                checkPasswordMatch();
            });
            
            password1Field.addEventListener('input', checkPasswordMatch);
        });

        function actualizar() {
            var passwordNueva = document.getElementById('password').value;
            var passwordRepetida = document.getElementById('password1').value;

            if (passwordNueva === '') {
                toastr.error('Contraseña nueva es requerida');
                return;
            }

            if (passwordRepetida === '') {
                toastr.error('Contraseña repetida es requerida');
                return;
            }

            if (passwordNueva.length > 16) {
                toastr.error('Máximo 16 caracteres para contraseña nueva');
                return;
            }

            if (passwordNueva.length < 4) {
                toastr.error('Mínimo 4 caracteres para contraseña nueva');
                return;
            }

            if (passwordRepetida.length > 16) {
                toastr.error('Máximo 16 caracteres para contraseña repetida');
                return;
            }

            if (passwordRepetida.length < 4) {
                toastr.error('Mínimo 4 caracteres para contraseña repetida');
                return;
            }

            if (passwordNueva !== passwordRepetida) {
                toastr.error('Las contraseñas no coinciden');
                return;
            }

            openLoading();
            var formData = new FormData();
            formData.append('password', passwordNueva);

            axios.post(url + '/editar-perfil/actualizar', formData, {})
                .then((response) => {
                    closeLoading();

                    if (response.data.success === 1) {
                        toastr.success('Contraseña actualizada correctamente');
                        document.getElementById('password').value = '';
                        document.getElementById('password1').value = '';
                        document.getElementById('strength-bar').className = 'password-strength-bar';
                        document.getElementById('password-match').innerHTML = '';
                    } else {
                        toastr.error('Error al actualizar la contraseña');
                    }
                })
                .catch((error) => {
                    closeLoading();
                    toastr.error('Error al actualizar la contraseña');
                });
        }
    </script>
@stop
