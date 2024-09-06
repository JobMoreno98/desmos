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
                    <div
                        class="p-3 investigador-card w-100 h-100 d-flex align-items-center justify-content-center {{ $investigador['nombre'] == 'Jubilados y finados' ? 'piso' : '' }}">
                        @if ($investigador['nombre'] == 'Jubilados y finados')
                            <div class="h-100 investigadores-card--info p-5 w-100 rounded shadow "
                                style="background: #edf2f4;color: #000;height: 100%;display: flex; align-items: center;border:2px solid #b13124;">
                                <h5 class="text-uppercase py-2" style="border-bottom:2px solid #b13124;">
                                    {{ $investigador['nombre'] }}
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

            nombre.innerHTML = isset(item['nombre']) ? item['nombre'] + " " + item['apellido'] : ''

            reconocimientos = document.getElementById('reconocimientos')

            reconocimientos.innerHTML = isset(item['reconocimientos']) ? "<b>Reconocimientos: </b> " + item[
                'reconocimientos'] : ''

            proyecto_invest = document.getElementById('proyecto_invest')

            proyecto_invest.innerHTML = isset(item['proyecto_invest']) ? " <b>Proyecto de investigación en proceso: </b> " +
                item['proyecto_invest'] : ''

            document.getElementById('publicaciones').innerHTML = isset(item['publicaciones']) ? "<b>Publicaciones: </b>" +
                item['publicaciones'] :
                ''

            document.getElementById('correo').innerHTML = isset(item['correo']) ? "<b>Contacto: </b>" + item['correo'] : ''

            document.getElementById('grado').innerHTML = isset(item['grado']) ? " <b>Grado: </b>" + item['grado'] : ''

            document.getElementById('lineasInves').innerHTML = isset(item['lineasInves']) ?
                "<b>Lineas de investigación: </b>" + item['lineasInves'] :
                ''

            if (item['estatus'] !== 1) {

                document.getElementById('estatus').innerHTML = isset(item['estatus']) ? "<b>Estatus:</b> " + item[
                        'status'] :
                    ''
            } else {
                document.getElementById('estatus').innerHTML = ''
            }

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

                    <p id="nombre" style="font-size:16pt;"></p>
                </div>
                <div class="modal-body">
                    <div class="informacionModal">
                        <div class="modal-info--item">
                            <span id="reconocimientos"></span>
                        </div>

                        <div class="modal-info--item">

                            <span id="proyecto_invest"></span>
                        </div>

                        <div class="modal-info--item">

                            <span id="publicaciones"></span>
                        </div>
                        <div class="modal-info--item">

                            <span id="correo"></span>
                        </div>
                        <div class="modal-info--item">

                            <span id="grado"></span>
                        </div>
                        <div class="modal-info--item">

                            <span id="lineasInves"></span>
                        </div>
                        <div>
                            <p id="estatus"></p>
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
