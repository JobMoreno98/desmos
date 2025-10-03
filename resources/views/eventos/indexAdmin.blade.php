@extends('layouts.app')

@section('content')
    @if (Auth::check() && Auth::user()->rol == 'admin')

        <div class="container-fluid ">
            <div class="row">
                <div class="col-12">

                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                        </div>
                    @endif
                    <br>
                </div>
            </div>
            <div class="row px-5">
                <div class="col-12">

                    <h2>Listado de eventos </h2>
                    <br>
                    <p align="right">
                        <a href="{{ route('eventos.create') }}" class="btn btn-success">Capturar Evento</a>
                        <a href="{{ route('home') }}" class="btn btn-primary">
                            < Regresar</a>
                    </p>
                    <table id="tabla" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Titulo</th>
                                <th>Fecha</th>
                                <th>Descripcion</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($eventos as $item)
                                <tr>
                                    <td>{{ $item['titulo'] }}</td>
                                    <td>{{ $item['fecha'] }}</td>
                                    <td>{!! $item['descripcion'] !!}</td>
                                    <td>{!! $item['acciones'] !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <p>
                <a href="{{ route('home') }}" class="btn btn-primary">
                    Regresar</a>
            </p>
        </div>
    @else
        Acceso No válido
    @endif
@endsection


@push('js')
    <script>
        
        $(document).ready(function() {
            console.log('Inicializando DataTable en tabla-eventos');
            $('#tabla').DataTable({
                pageLength: 10,
                order: [
                    [1, "desc"]
                ],
                language: {
                    sProcessing: "Procesando...",
                    sLengthMenu: "Mostrar _MENU_ registros",
                    sZeroRecords: "No se encontraron resultados",
                    sEmptyTable: "Ningún dato disponible en esta tabla",
                    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0 registros",
                    sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
                    sSearch: "Buscar:",
                    oPaginate: {
                        sFirst: "Primero",
                        sLast: "Último",
                        sNext: "Siguiente",
                        sPrevious: "Anterior"
                    },
                    oAria: {
                        sSortAscending: ": Activar para ordenar la columna de manera ascendente",
                        sSortDescending: ": Activar para ordenar la columna de manera descendente"
                    }
                },
                responsive: true,
                dom: '<"col-xs-3"l><"col-xs-5"B><"col-xs-4"f>rtip',
                buttons: [
                    'copy', 'excel',
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LETTER',
                    }
                ]
            });
        });


        //"columnDefs": [{ type: 'portugues', targets: "_all" }],
    </script>
@endpush
