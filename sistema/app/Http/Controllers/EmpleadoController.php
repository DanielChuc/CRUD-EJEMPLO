<?php

namespace App\Http\Controllers;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class EmpleadoController extends Controller
{
    /**
     * Mostrar una lista del recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //!Consultamos y pasamos a index
        $datos['empleados'] = Empleado::paginate(2);
        return view('empleado.index',$datos);
    }

    /**
     * Mostrar el formulario para crear un nuevo recurso.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //!Mostramos el formulario de create
        return view('empleado.create');
        
    }

    /**
     * Almacenar un recurso recién creado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //!Validaciones
        $campos = [
            'Nombre' =>'required|string|max:100',
            'ApellidoPaterno' =>'required|string|max:100',
            'ApellidoMaterno' =>'required|string|max:100',
            'Correo' =>'required|email',
            'Fotografia' =>'required|max:10000|mimes:jpeg,png,jpg',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
            'Fotografia.required'=>'La fotografia es requerida'
        ];
        $this->validate($request,$campos,$mensaje);

        //!Obetenemos los datos pero sacamos el token del formulario
        $datosEmpleado = request()->except('_token');
        //!valodamos si existe una Fotografia y lo guardamos con el nombre
        if ($request->hasFile('Fotografia')) {
            $datosEmpleado['Fotografia']=$request->file('Fotografia')->store('uploads','public');
        }
        //!guardamos los datos en la tabla de empleados
        Empleado::insert($datosEmpleado);

        return redirect('empleado')->with('mensaje','Empleado agregado con exito');
    }

    /**
     * Mostrar el recurso especificado.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Mostrar el formulario para editar el recurso especificado.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //!Mostramos el formulario de edit
        $empleado=Empleado::findOrFail($id);
        return view('empleado.edit',compact('empleado'));
        
    }

    /**
     * Actualizar el recurso especificado en el almacenamiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         //!Validaciones
        $campos = [
            'Nombre' =>'required|string|max:100',
            'ApellidoPaterno' =>'required|string|max:100',
            'ApellidoMaterno' =>'required|string|max:100',
            'Correo' =>'required|email',
        ];
        $mensaje=[
            'required'=>'El :attribute es requerido',
        ];
        //!validación de la Fotografia cuando esta exista en la actualización de datos
        if ($request->hasFile('Fotografia')){
            $campos=['Fotografia' =>'required|max:10000|mimes:jpeg,png,jpg'];
            $mensaje=['Fotografia.required'=>'La fotografia es requerida'];
    }

    $this->validate($request,$campos,$mensaje);


        //!Obetenemos los datos pero sacamos el token y el metodo del formulario
        $datosEmpleado = request()->except(['_token','_method']);
        //!valodamos si existe una Fotografia y lo guardamos con el nombre
        if ($request->hasFile('Fotografia')) {
            //!borramos la fotografia anterior
            $empleado=Empleado::findOrFail($id);
            Storage::delete('public/'.$empleado->Fotografia);
            $datosEmpleado['Fotografia']=$request->file('Fotografia')->store('uploads','public');
        }
        Empleado::where('id','=',$id)->update($datosEmpleado);
        //!Mostramos el formulario de edit con el registro actualizado
        $empleado=Empleado::findOrFail($id);


        //return view('empleado.edit',compact('empleado'));
        return  redirect('empleado')->with('mensaje','Empleado Modificado Con Exito');

    }

    /**
     * Quitar el recurso especificado del almacenamiento.
     *
     * @param  \App\Models\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //!borramos un registro y la fotografia según el id que le pasemos

        $empleado=Empleado::findOrFail($id);
        if (Storage::delete('public/'.$empleado->Fotografia)) {
            Empleado::destroy($id);

        }

        return  redirect('empleado')->with('mensaje','Empleado Borrado Con Exito');
    }
}
