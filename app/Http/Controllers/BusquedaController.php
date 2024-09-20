<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Investigador;
use App\Models\Publicacion;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Pagination\Paginator;
use \Illuminate\Support\Facades\Request as ResquestPaginate;

class BusquedaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $busqueda = $request->search;
        $i = 0;
        $resultados = collect([]);
        $resultadosBusqueda = collect([]);

        $eventos = Evento::search($busqueda)->where('activo', 1)->get();
        $publicaciones = Publicacion::search($busqueda)->where('activo', 1)->get();
        $investigadores = Investigador::search($busqueda)->where('activo', 1)->get();
        
        $resultadosBusqueda = $resultadosBusqueda->concat($eventos);
        $resultadosBusqueda = $resultadosBusqueda->concat($publicaciones);
        $resultadosBusqueda = $resultadosBusqueda->concat($investigadores);

        

        foreach ($resultadosBusqueda as $resultado) {
            if ($resultado) {
                $id = $resultado->id;
                $titulo = class_basename($resultado) == 'Investigador' ? $resultado->grado . ' ' . $resultado->nombre . ' ' . $resultado->apellido : $resultado->titulo;
                $descripcion = class_basename($resultado) == 'Investigador' ? strip_tags($resultado->publicaciones) : strip_tags($resultado->descripcion);
                $descripcionforSubstr = strtolower($descripcion);
                $descripcionforSubstr = str_replace(
                    array('á', 'é', 'í', 'ó', 'ú'),
                    array('a', 'e', 'i', 'o', 'u'),
                    $descripcionforSubstr
                );
                $busquedaReplace = str_replace(
                    array('á', 'é', 'í', 'ó', 'ú'),
                    array('a', 'e', 'i', 'o', 'u'),
                    $busqueda
                );
                $busquedaReplace = strtolower($busquedaReplace);
                $keywordPos = strpos($descripcionforSubstr, $busquedaReplace);

                if ($keywordPos > 0) {
                    $descripcionKeyword = '...' . substr($descripcionforSubstr, $keywordPos - 50, 50) . '<b>' . substr($descripcionforSubstr, $keywordPos, strlen($busquedaReplace)) . '</b>' . substr($descripcionforSubstr, ($keywordPos + strlen($busquedaReplace)), 50) . '...';
                } elseif ($keywordPos === 0) {
                    $descripcionKeyword = '<b>' . substr($descripcionforSubstr, $keywordPos, strlen($busquedaReplace)) . '</b>' . substr($descripcionforSubstr, ($keywordPos + strlen($busquedaReplace)), 50) . '...';
                } else {
                    $descripcionKeyword = substr($descripcion, 0, 100) . '...';
                }
                $resultados['' . $i] = collect([
                    'id' => $id,
                    'titulo' => $titulo,
                    'descripcion' => $descripcionKeyword,
                    'route' => $resultado->route,
                    'keywordpos' => $keywordPos,
                ]);
                $i++;
            }
        }
        $resultados = $this->paginate($resultados->toArray());
        if ($busqueda) {
            return view('busqueda', compact('resultados', 'busqueda'));
        } else {
            return view('layouts.plantilla');
        }
    }

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
}
