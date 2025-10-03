<?php

namespace App\Http\Controllers;

use App\Models\Contacto;
use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function index()
    {

        $contactos = Contacto::where('activo', '=', 1)->get();
        return view('contactos.index', compact('contactos'));
    }
    public function indexAdmin()
    {
        $vscontactos = Contacto::where('activo', '=', 1)->get();
        $contactos = $this->cargarDT($vscontactos);
        return view('contactos.indexAdmin', compact('contactos'));
    }
    public function cargarDT($consulta)
    {
        $contacto = [];

        foreach ($consulta as $key => $value) {

            $ruta = "eliminar" . $value->id;
            $eliminar = route('delete-contacto', $value->id);
            $actualizar =  route('contactos.edit', $value->id);


            $acciones = view('partials.acciones', compact('value', 'ruta', 'eliminar', 'actualizar'))->render();

            $contacto[$key] = array(
                $value['titulo'],
                $value['nombre'],
                $acciones
            );
        }

        return $contacto;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contactos.create');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validateData = $this->validate($request, [
            'titulo' => 'required',
            'nombre' => 'required',

        ]);

        $contacto = new Contacto();
        $contacto->titulo = $request->input('titulo');
        $contacto->nombre = $request->input('nombre');
        $contacto->correo = $request->input('correo');
        $contacto->telefono = $request->input('telefono');



        $contacto->save();
        return redirect()->route('contactos.create')->with(array(
            'message' => 'El contacto se guardó correctamente'
        ));
    }


    public function delete_contacto($contacto_id)
    {
        $contacto = Contacto::find($contacto_id);
        if ($contacto) {
            $contacto->activo = 0;
            $contacto->update();
            // //
            //     $log = new Log();
            //     $log->tabla = "areas";
            //     $mov="";
            //     $mov=$mov." tipo_espacio:".$area->tipo_espacio ." sede:". $area->sede ." edificio" .$area->edificio;
            //     $mov=$mov." piso:".$area->piso ." division:". $area->division ." coordinacion" .$area->coordinacion;
            //     $mov=$mov." equipamiento:".$area->equipamiento ." area:". $area->area .".";
            //     $log->movimiento = $mov;
            //     $log->usuario_id = Auth::user()->id;
            //     $log->acciones = "Borrado";
            //     $log->save();
            //
            return redirect()->route('contactos.indexAdmin')->with(array(
                "message" => "El contacto se ha eliminado correctamente"
            ));
        } else {
            return redirect()->route('home')->with(array(
                "message" => "El contacto que trata de eliminar no existe"
            ));
        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contacto = Contacto::find($id);
        return view('contactos.edit')->with('contacto', $contacto);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $this->validate($request, [
            'titulo' => 'required',
            'nombre' => 'required',


        ]);

        $contacto = Contacto::find($id);
        $contacto->titulo = $request->input('titulo');
        $contacto->nombre = $request->input('nombre');
        $contacto->correo = $request->input('correo');
        $contacto->telefono = $request->input('telefono');



        $contacto->update();
        return redirect()->route('contactos.indexAdmin')->with(array(
            'message' => 'El contacto se actualizó correctamente'
        ));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
