@extends('layouts.plantilla')

@section('content')
    <div class="container busqueda-container mt-5 pt-5">
        <h1>Resultados de búsqueda: {{ $busqueda }}</h1>
        <h6>{{ count($resultados) . ' coincidencias' }}</h6>
        @foreach ($resultados as $resultado)
            <div class="row">
                <div class="col-sm-12">
                    <a href="{{ $resultado['route'] }}">
                        <h6>{{ $resultado['titulo'] }}</h6>
                    </a>
                    <p>{!! $resultado['descripcion'] !!}</p>
                </div>
            </div>
        @endforeach
        @if (count($resultados) > 0)
            <div class="d-flex">
                {!! $resultados->links('pagination::bootstrap-4') !!}
            </div>
        @endif
    </div>
@endsection
