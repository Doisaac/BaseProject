@section('content')
<div class="container">
  <h1>Listado de Vehículos</h1>

  @if(session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <a href="{{ route('vehiculos.create') }}" class="btn btn-primary mb-3">Registrar Vehículo</a>

  <table class="table table-bordered">
    <thead>
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
      @foreach ($vehiculos as $vehiculo)
      <tr>
        <td>{{ $vehiculo->placa }}</td>
        <td>{{ $vehiculo->marca }}</td>
        <td>{{ $vehiculo->modelo }}</td>
        <td>{{ $vehiculo->año }}</td>
        <td>{{ ucfirst($vehiculo->estado) }}</td>
        <td>
          <a href="" class="btn btn-sm btn-warning">Editar</a>

          <form action="" method="POST" style="display:inline-block;">
            <button class="btn btn-sm btn-danger" onclick="return confirm('¿Estás seguro de eliminar este vehículo?')">Eliminar</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>