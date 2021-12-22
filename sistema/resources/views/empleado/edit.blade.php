{{-- Mandamos el id al update --}}
@extends('layouts.app')
@section('content')
<div class="container">

<form action="{{ url('/empleado/'.$empleado->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    {{-- Le ponemos el metodo patch para que se identifique como update --}}
    {{ method_field('PATCH') }}

    @include('empleado.form',['modo'=>'Editar'])
</form>
</div>
@endsection