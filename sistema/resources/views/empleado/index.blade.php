@extends('layouts.app')
@section('content')
    <div class="container">
{{-- Todos los mensajes de error y los resultados --}} 
        @if (Session::has('mensaje'))
            <div class="alert alert-success  alert-dismissible fade show" role="alert">

                {{ Session::get('mensaje') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
        @endif





        <a href="{{ url('/empleado/create') }}" class="btn btn-success">Registrar Nuevo Empleado</a>
        <table class="table table-light">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Fotografia:</th>
                    <th>Nombre:</th>
                    <th>Apellido Paterno:</th>
                    <th>Apellido Materno:</th>
                    <th>Correo:</th>
                    <th>Acciones:</th>


                </tr>
            </thead>
            <tbody>
                @foreach ($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->id }}</td>
                        <td>
                            <img class="img-thumbnail img-fluid" src="{{ asset('storage') . '/' . $empleado->Fotografia }}"
                                alt="" width="100">
                        </td>
                        <td>{{ $empleado->Nombre }}</td>
                        <td>{{ $empleado->ApellidoPaterno }}</td>
                        <td>{{ $empleado->ApellidoPaterno }}</td>
                        <td>{{ $empleado->Correo }}</td>
                        <td>

                            <a href="{{ url('empleado/' . $empleado->id . '/edit') }}" class="btn btn-warning">
                                Editar
                            </a>
                            |

                            {{-- Borrrar un campo, en la url empleado le concatenamos el id --}}
                            <form action="{{ url('/empleado/' . $empleado->id) }}" class="d-inline" method="post">
                                @csrf
                                {{-- le ponemos el metodo delete para que se confirme que es un delete --}}
                                {{ method_field('DELETE') }}
                                {{-- Realizamos un aviso de confirmación y borramos --}}
                                <input type="submit" onclick="return confirm('¿Quierres borrar?')" value="Borrar"
                                    class="btn btn-danger">
                            </form>
                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>
        {{-- Para realizar esto revisa AppServiceProvider ya que de alli sale la paginación --}}
        {!! $empleados->links() !!}
    </div>
@endsection
