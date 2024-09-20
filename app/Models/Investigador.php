<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Investigador extends Model
{
    use HasFactory;
    use Searchable;
    protected $appends = ['status'];

    public function toSearchableArray()
    {
        return [
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'grado' => $this->grado,
        ];
    }

    protected function getStatusAttribute()
    {
        $estatus = ['Activo', 'Jubilado(a)', 'Finado(a)', 'Cambio de Adscripción', 'Otro'];
        return $estatus[$this->estatus - 1];
    }
    public function getRouteAttribute()
    {
        $ruta = route('investigadores.show', $this->id);
        return $ruta;
    }
}
