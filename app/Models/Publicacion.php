<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use mysql_xdevapi\Table;

class Publicacion extends Model
{
    // use HasFactory;
    use Searchable;
    protected $table = 'publicacions';

    public function toSearchableArray()
    {

        return [
            'titulo' => $this->titulo,
            'descripcion' => $this->descripcion,
        ];
    }
    public function archivos()
    {
        return $this->hasMany(Archivo::class);
    }
    public function getRouteAttribute()
    {
        if ($this->categoria == 3)
            $route = 'divulgaciones.show';
        elseif ($this->categoria == 2) {
            $route = 'articulos.show';
        } else {
            $route = 'libros.show';
        }
        $ruta = route($route, $this->id);
        return $ruta;
    }
}
