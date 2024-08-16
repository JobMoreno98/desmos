@extends('layouts.plantilla')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-12 text-center heading-section ftco-animate">
                <h2 class="mb-4 text-uppercase">Investigadores</h2>
            </div>
        </div>
        <div class="row justify-content-center my-2">
            @foreach ($investigadores as $investigador)
                <div class="col-md-3 col-sm-10 my-2">
                    <div class="p-3 investigador-card w-100 d-flex align-items-center justify-content-center" style="height: 100%;">
                        @if ($investigador['nombre'] == 'Jubilados y finados')
                            <div class="investigadores-card--info border p-5 border-bottom border-dark w-100 rounded shadow"
                                style="height: 100%;display: flex; align-items: center;">
                                <h5 class="text-uppercase py-2 border-bottom border-dark ">{{ $investigador['nombre'] }}
                                </h5>
                            </div>
                        @else
                            <div class="img-border-rounded">
                                @if (isset($investigador['image']) && Storage::disk('images-investigadores')->has($investigador['image']))
                                    <img src="{{ url('/storage/images/investigadores/' . $investigador['image']) }}" />
                                @endif
                            </div>
                            <div class="investigadores-card--info">
                                <h4>{{ $investigador['nombre'] . ' ' . $investigador['apellido'] }}</h4>
                                <h5>Estado: {{ $investigador['status'] }}</h5>
                                <h5>{{ $investigador['grado'] }}</h5>
                                <h6>Linea de investigación: <i>{{ substr($investigador['lineasInves'], 0, 63) . '...' }}</i>
                                </h6>
                            </div>
                            <br>
                            <button type="button" class="btn btn-info btnModal" data-toggle="modal"
                                data-target="#modalInvest" onclick="modal({{ json_encode($investigador) }})">Info</button>
                        @endif

                    </div>

                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center ">
            {{ $investigadores->links() }}
        </div>
    </div>

    <script>
        function isset(ref) {
            return ref !== null
        }

        function modal(item) {

            const image = "{{ asset('storage/images/investigadores/') }}" + "/" + item['image']

            document.getElementById('img').src = image

            nombre = document.getElementById('nombre')

            nombre.innerHTML = isset(item['nombre']) ? item['nombre'] + " " + item['apellido'] : 'No disponible'

            reconocimientos = document.getElementById('reconocimientos')

            reconocimientos.innerHTML = isset(item['reconocimientos']) ? item['reconocimientos'] : 'No disponible'

            proyecto_invest = document.getElementById('proyecto_invest')

            proyecto_invest.innerHTML = isset(item['proyecto_invest']) ? item['proyecto_invest'] : 'No disponible'

            document.getElementById('publicaciones').innerHTML = isset(item['publicaciones']) ? item['publicaciones'] :
                'No disponible'

            document.getElementById('correo').innerHTML = isset(item['correo']) ? item['correo'] : 'No disponible'

            document.getElementById('grado').innerHTML = isset(item['grado']) ? item['grado'] : 'No disponible'

            document.getElementById('lineasInves').innerHTML = isset(item['lineasInves']) ? item['lineasInves'] :
                'No disponible'
        }
    </script>
@endsection


@section('modal')
    <div class="modal fade" id='modalInvest'>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="img-border-rounded">

                        <img id="img" src="" />

                    </div>
                    <h1 id="nombre"></h1><br>
                </div>
                <div class="modal-body">
                    <div class="informacionModal">
                        <div class="modal-info--item">
                            <b>Reconocimientos: </b> <span id="reconocimientos"></span>
                        </div>

                        <div class="modal-info--item">
                            <b>Proyecto de investigación en proceso: </b>
                            <span id="proyecto_invest"></span>
                        </div>

                        <div class="modal-info--item">
                            <b>Publicaciones: </b>
                            <span id="publicaciones"></span>
                        </div>
                        <div class="modal-info--item">
                            <b>Contacto: </b>
                            <span id="correo"></span>
                        </div>
                        <div class="modal-info--item">
                            <b>Grado: </b>
                            <span id="grado"></span>
                        </div>
                        <div class="modal-info--item">
                            <b>Lineas de investigación: </b>
                            <span id="lineasInves"></span>
                        </div>


                    </div>

                </div>
                <div class="modal-footer">
                    <input class="btn btn-primary" data-dismiss="modal" value="Cerrar">
                </div>
            </div>
        </div>

    </div>
@endsection
