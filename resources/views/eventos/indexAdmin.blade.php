@extends('layouts.app')

@section('content')
    @if (Auth::check() && Auth::user()->rol == 'admin')

        <div class="container ">
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
                    <p class="text-end">
                        <a href="{{ route('eventos.create') }}" class="btn btn-success">Capturar Evento</a>
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
                                    <td data-order="{{ \Carbon\Carbon::parse($item['fecha'])->format('Y-m-d') }}">
                                        {{ \Carbon\Carbon::parse($item['fecha'])->translatedFormat('  j \\d\\e F \\d\\e  Y') }}
                                    </td>
                                    <td>{!! $item['descripcion'] !!}</td>
                                    <td>{!! $item['acciones'] !!}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

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
                columnControl: ['order', 'colVisDropdown'],
                ordering: {
                    indicators: false,
                    handler: false
                },
                columnDefs: [{
                    target: [2],
                    visible: false
                }],
                pageLength: 10,
                order: [
                    [1, "desc"]
                ],
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
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
        jQuery.extend(jQuery.fn.dataTableExt.oSort, {
            "portugues-pre": function(data) {
                var a = 'a';
                var e = 'e';
                var i = 'i';
                var o = 'o';
                var u = 'u';
                var c = 'c';
                var special_letters = {
                    "Á": a,
                    "á": a,
                    "Ã": a,
                    "ã": a,
                    "À": a,
                    "à": a,
                    "É": e,
                    "é": e,
                    "Ê": e,
                    "ê": e,
                    "Í": i,
                    "í": i,
                    "Î": i,
                    "î": i,
                    "Ó": o,
                    "ó": o,
                    "Õ": o,
                    "õ": o,
                    "Ô": o,
                    "ô": o,
                    "Ú": u,
                    "ú": u,
                    "Ü": u,
                    "ü": u,
                    "ç": c,
                    "Ç": c
                };
                for (var val in special_letters)
                    data = data.split(val).join(special_letters[val]).toLowerCase();
                return data;
            },
            "portugues-asc": function(a, b) {
                return ((a < b) ? -1 : ((a > b) ? 1 : 0));
            },
            "portugues-desc": function(a, b) {
                return ((a < b) ? 1 : ((a > b) ? -1 : 0));
            }
        });

        //"columnDefs": [{ type: 'portugues', targets: "_all" }],
    </script>
@endpush
