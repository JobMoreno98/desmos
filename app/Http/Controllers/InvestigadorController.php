<?php

namespace App\Http\Controllers;

use App\Models\Investigador;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use \Illuminate\Support\Facades\Request as ResquestPaginate;

class InvestigadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function paginate($items, $perPage = 12, $page = null)
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $total = count($items);
        $currentpage = $page;
        $offset = ($currentpage * $perPage) - $perPage ;
        $itemstoshow = array_slice($items , $offset , $perPage);


        return new LengthAwarePaginator($itemstoshow, $total, $perPage, $page,
            ['path'=> ResquestPaginate::fullUrl()]);
    }

    public function index()
    {

        $investigadores_jubilados = Investigador::where('activo', '=', 1)->where('estatus', '!=', 1)->orderBy('apellido', 'asc')->get();

        $investigadores = Investigador::where('activo', '=', 1)->where('estatus', 1)->orderBy('apellido', 'asc')->get();
        $investigador = new Investigador();
        $investigador->nombre = 'Jubilados y finados';
        $investigador->image = '';
        $investigador->estatus = 1;

        $investigadores = $investigadores->merge([$investigador]);

        $investigadores = $investigadores->merge($investigadores_jubilados)->toArray();

        $investigadores = $this->paginate($investigadores);

        return view('investigadores.index', compact('investigadores'));
    }
    public function indexAdmin()
    {
        $vsinvestigadores = Investigador::where('activo', '=', 1)->get();
        $investigadores = $this->cargarDT($vsinvestigadores);
        return view('investigadores.indexAdmin', compact('investigadores'));
    }
    public function cargarDT($consulta)
    {
        $investigador = [];

        foreach ($consulta as $key => $value) {

            $ruta = "eliminar" . $value['id'];
            $eliminar = route('delete-investigador', $value['id']);
            $actualizar =  route('investigadores.edit', $value['id']);


            $acciones = '
                <div class="btn-acciones">
                    <div class="btn-circle d-flex">
                        <a href="' . $actualizar . '" role="button" class="btn btn-success m-1" title="Actualizar">
                            <i class="far fa-edit"></i>
                        </a>
                        <a href="#' . $ruta . '" role="button" class="btn btn-danger m-1" data-toggle="modal" title="Eliminar">
                            <i class="far fa-trash-alt"></i>
                        </a>
                    </div>
                </div>
                <div class="modal fade" id="' . $ruta . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">¿Seguro que deseas eliminar este investigador?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <p class="text-primary">
                        <small>
                            ' . $value['id'] . '. ' . $value['nombre'] . ' ' . $value['apellido'] . '                 </small>
                      </p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                      <a href="' . $eliminar . '" type="button" class="btn btn-danger">Eliminar</a>
                    </div>
                  </div>
                </div>
              </div>
            ';

            $investigador[$key] = array(
                $value['nombre'],
                $value['apellido'],
                $value['grado'],
                $value['lineasInves'],
                $value['correo'],
                $value['proyecto_invest'],
                $value['reconocimientos'],
                $value['publicaciones'],
                $acciones,
            );
        }

        return $investigador;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('investigadores.create');
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
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'linea_investigacion' => 'required',
            'grado' => 'required',
            'publicaciones' => 'required',
            'image' => 'image|max:5120',
            'estatus' => 'required'
        ]);

        $investigador = new Investigador();
        $investigador->nombre = $request->input('nombre');
        $investigador->apellido = $request->input('apellido');
        $investigador->lineasInves = $request->input('linea_investigacion');
        $investigador->correo = $request->input('correo');
        $investigador->proyecto_invest = $request->input('proyecto_invest');
        $investigador->reconocimientos = $request->input('reconocimientos');
        $investigador->publicaciones = $request->input('publicaciones');
        $investigador->grado = $request->input('grado');
        $investigador->estatus = $request->input('estatus');


        $image = $request->file('imagen');
        if ($image) {
            $image_path = time() . $image->getClientOriginalName();
            \Storage::disk('images-investigadores')->put($image_path, \File::get($image));

            $investigador->image = $image_path;
        }
        $investigador->save();
        return redirect()->route('investigadores.create')->with(array(
            'message' => 'El investigador se guardó correctamente'
        ));
    }
    public function getImage($filename)
    {
        $file = Storage::disk('images-investigadores')->get($filename);
        return new Response($file, 200);
    }

    public function delete_investigador($investigador_id)
    {
        $investigador = Investigador::find($investigador_id);
        if ($investigador) {
            $investigador->activo = 0;
            $investigador->update();
            return redirect()->route('investigadores.indexAdmin')->with(array(
                "message" => "El investigador se ha eliminado correctamente"
            ));
        } else {
            return redirect()->route('home')->with(array(
                "message" => "El investigador que trata de eliminar no existe"
            ));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($investigador_id)
    {
        $investigador = Investigador::where("activo", "=", 1)->find($investigador_id);
        return view('investigadores.show', compact('investigador'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $investigador = Investigador::find($id);
        return view('investigadores.edit')->with('investigador', $investigador);
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
        $this->validate($request, [
            'nombre' => 'required',
            'apellido' => 'required',
            'linea_investigacion' => 'required',
            'grado' => 'required',
            'publicaciones' => 'required',
            'image' => 'image|max:5120',
            'estatus' => 'required'
        ]);

        $investigador = Investigador::find($id);
        $investigador->nombre = $request->input('nombre');
        $investigador->apellido = $request->input('apellido');
        $investigador->lineasInves = $request->input('linea_investigacion');
        $investigador->correo = $request->input('correo');
        $investigador->proyecto_invest = $request->input('proyecto_invest');
        $investigador->reconocimientos = $request->input('reconocimientos');
        $investigador->publicaciones = $request->input('publicaciones');
        $investigador->grado = $request->input('grado');
        $investigador->estatus = $request->input('estatus');


        $image = $request->file('imagen');
        if ($image) {
            $image_path = time() . $image->getClientOriginalName();
            \Storage::disk('images-investigadores')->put($image_path, \File::get($image));

            $investigador->image = $image_path;
        }



        $investigador->update();
        return redirect()->route('investigadores.indexAdmin')->with(array(
            'message' => 'El investigador se actualizó correctamente'
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
