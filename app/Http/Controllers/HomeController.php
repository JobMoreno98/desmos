<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $array = [
            [
                'titulo' => 'Investigadores',
                'icon' => 'book_2',
                'enlaces' => [
                    'consultar' => route('investigadores.indexAdmin'),
                    'crear' => route('investigadores.create')
                ]

            ],
            [
                'titulo' => 'Eventos',
                'icon' => 'calendar_month',
                'enlaces' => [
                    'consultar' => route('eventos.indexAdmin'),
                    'crear' => route('eventos.create')
                ]

            ],
            [
                'titulo' => 'Divulgación',
                'icon' => 'newsmode',
                'enlaces' => [
                    'consultar' => route('divulgaciones.indexAdmin'),
                    'crear' => route('divulgaciones.create')
                ]

            ],
            [
                'titulo' => 'Libros y capítulos',
                'icon' => 'library_books',
                'enlaces' => [
                    'consultar' => route('divulgaciones.indexAdmin'),
                    'crear' => route('divulgaciones.create')
                ]

            ],
            [
                'titulo' => 'Artículos',
                'icon' => 'article',
                'enlaces' => [
                    'consultar' => route('articulos.indexAdmin'),
                    'crear' => route('articulos.create')
                ]

            ],
            [
                'titulo' => 'Quiénes somos',
                'icon' => 'page_info',
                'enlaces' => [
                    'consultar' => route('quienes-somos.indexAdmin'),
                    'crear' => route('quienes-somos.create')
                ]

            ],
            [
                'titulo' => 'Contactos',
                'icon' => 'contact_page',
                'enlaces' => [
                    'consultar' => route('contactos.indexAdmin'),
                    'crear' => route('contactos.create')
                ]

            ],
            [
                'titulo' => 'Usuarios',
                'icon' => 'group',
                'enlaces' => [
                    'consultar' => route('usuarios.indexAdmin'),
                    'crear' => route('usuarios.create')
                ]

            ]
        ];
        $coleccion = $this->deepCollect($array);
        return view('home', compact('coleccion'));
    }
    function deepCollect($array): Collection
    {
        return collect($array)->map(function ($item) {
            return is_array($item) ? $this->deepCollect($item) : $item;
        });
    }
}
