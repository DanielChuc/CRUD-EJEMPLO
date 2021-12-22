<h1>{{ $modo }} Empleado</h1>
{{-- errores --}}
@if (count($errors) >0)

    <div class="alert alert-danger" role="alert">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

    </div>

@endif
<div class="form-group">
    <label for="Nombre">Nombre: </label>
    <input class="form-control" type="text" name="Nombre" value="{{ $empleado->Nombre ?? old('Nombre') }}" id="Nombre">
</div>
<div class="form-group">
    <label for="ApellidoPaterno">ApellidoPaterno: </label>
    <input class="form-control" type="text" name="ApellidoPaterno" value="{{ $empleado->ApellidoPaterno ?? old('ApellidoPaterno') }}"
        id="ApellidoPaterno">
</div>
<div class="form-group">
    <label for="ApellidoMaterno">ApellidoMaterno: </label>
    <input class="form-control" type="text" name="ApellidoMaterno" value="{{ $empleado->ApellidoMaterno ?? old('ApellidoMaterno') }}"
        id="ApellidoMaterno">
</div>
<div class="form-group">
    <label for="Correo">Correo: </label>
    <input class="form-control" type="email" name="Correo" value="{{ $empleado->Correo ?? old('Correo') }}" id="Correo">
</div>
<div class="form-group">
    <label for="Foto">Fotografia: </label>
    <input class="form-control" type="file" name="Fotografia" value="{{ $empleado->Fotografia ?? old('Fotografia') }}"
        id="Fotografia">
    @if (isset($empleado->Fotografia))
        <img src="{{ asset('storage') . '/' . $empleado->Fotografia }}" alt="" width="100">

    @endif
</div>

<br>
<input class="btn btn-success" type="submit" value="{{ $modo }} datos">

<a class="btn btn-primary" href="{{ url('/empleado/') }}">Regresar</a>
