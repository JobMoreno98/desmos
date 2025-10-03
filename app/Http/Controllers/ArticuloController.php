<?php

namespace App\Http\Controllers;

use App\Models\Archivo;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;


class ArticuloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articulos = Publicacion::where('activo', '=', 1)->where('categoria', '=', 2)->orderBy('anio', 'desc')->paginate(16);
        return view('articulos.index', compact('articulos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articulos.create');
    }
    public function indexAdmin()
    {
        $vsarticulos = Publicacion::where('activo', '=', 1)->where('categoria', '=', 2)->get();
        $articulos = $this->cargarDT($vsarticulos);
        return view('articulos.indexAdmin', compact('articulos'));
    }
    public function cargarDT($consulta)
    {
        $articulo = [];

        foreach ($consulta as $key => $value) {

            $ruta = "eliminar" . $value['id'];
            $eliminar = route('delete-articulo', $value->id);
            $actualizar =  route('articulos.edit', $value->id);


            $acciones = view('partials.acciones', compact('value', 'ruta', 'eliminar', 'actualizar'))->render();

            $articulo[$key] = array(
                $value['id'],
                $value['titulo'],
                $value['descripcion'],
                $value['anio'],
                $acciones
            );
        }

        return $articulo;
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
            'descripcion' => 'required',
        ]);

        $articulo = new Publicacion();
        $articulo->titulo = $request->input('titulo');
        $articulo->descripcion = $request->input('descripcion');
        $articulo->anio = $request->input('anio');
        $articulo->categoria = 2;

        $image = $request->file('imagen');
        if ($image) {
            $image_path = time() . $image->getClientOriginalName();
            \Storage::disk('images-publicaciones')->put($image_path, \File::get($image));

            $articulo->image = $image_path;
        }


        $articulo->save();

        $files = $request->file('files');

        if ($files) {
            foreach ($files as $file) {

                $archivo = new Archivo();
                // $archivo->evento_id = $evento->id;
                $file_path = time() . $file->getClientOriginalName();
                \Storage::disk('files')->put($file_path, \File::get($file));
                $data[] = $file_path;

                $archivo->path = $file_path;
                $articulo->archivos()->save($archivo);
                $articulo->refresh();
            }
        }

        return redirect()->route('articulos.create')->with(array(
            'message' => 'El articulo se guardó correctamente'
        ));
    }
    public function delete_articulo($articulo_id)
    {
        $articulo = Publicacion::find($articulo_id);
        if ($articulo) {
            $articulo->activo = 0;
            $articulo->update();
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
            return redirect()->route('articulos.indexAdmin')->with(array(
                "message" => "El articulo se ha eliminado correctamente"
            ));
        } else {
            return redirect()->route('home')->with(array(
                "message" => "El articulo que trata de eliminar no existe"
            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response2
     */
    public function show($articulo_id)
    {
        $articulo = Publicacion::where('categoria', '=', 2)->where("activo", "=", 1)->find($articulo_id);
        $archivos = $articulo->archivos()->where('activo', 1)->get();
        return view('articulos.show', compact('articulo', 'archivos'));
    }

    public function getImage($filename)
    {
        $file = Storage::disk('images-publicaciones')->get($filename);
        return new Response($file, 200);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $articulo = Publicacion::find($id);
        $archivos = $articulo->archivos()->where('activo', 1)->get();

        return view('articulos.edit', compact('articulo', 'archivos'));
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
            'descripcion' => 'required',

        ]);

        $articulo = Publicacion::find($id);
        $articulo->titulo = $request->input('titulo');
        $articulo->descripcion = $request->input('descripcion');
        $articulo->anio = $request->input('anio');
        $articulo->categoria = 2;

        $image = $request->file('imagen');
        if ($image) {
            $image_path = time() . $image->getClientOriginalName();
            \Storage::disk('images-publicaciones')->put($image_path, \File::get($image));

            $articulo->image = $image_path;
        }




        $articulo->update();

        $files = $request->file('files');

        if ($files) {
            foreach ($files as $file) {

                $archivo = new Archivo();
                // $archivo->evento_id = $evento->id;
                $file_path = time() . $file->getClientOriginalName();
                \Storage::disk('files')->put($file_path, \File::get($file));
                $data[] = $file_path;

                $archivo->path = $file_path;
                $articulo->archivos()->save($archivo);
                $articulo->refresh();
            }
        }

        return redirect()->route('articulos.indexAdmin')->with(array(
            'message' => 'El articulo se actualizó correctamente'
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
