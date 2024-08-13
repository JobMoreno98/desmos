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
                    <div class="p-3 investigador-card w-100 d-flex align-items-center justify-content-center"
                        style="min-height: 100%;">

                        @if ($investigador['nombre'] == 'Jubilados y finados')
                            <div class="investigadores-card--info ">
                                <h5 class="text-uppercase">{{ $investigador['nombre'] }}</h5>

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
                                data-target="#modalInvest" onclick="modal([{{ json_encode($investigador) }}])">Info</button>
                        @endif

                    </div>

                </div>
            @endforeach
            <div id="contenedor">

            </div>
        </div>
        {!! $investigadores->links() !!}

    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $(document).on('click', '.page-link', function(event) {
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                console.log("PAGE: " + page)
            });
        });

        function modal(item) {

        }
    </script>
@endsection


@section('modal')
    <div class="modal fade" id='modalInvest'>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="img-border-rounded">

                        <img src="" />

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
