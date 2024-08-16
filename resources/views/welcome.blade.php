@extends('layouts.plantillaIndex')
@section('content')
    <section id="home" class="ftco-section bg-light">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-12 text-center heading-section ftco-animate">
                    <h2 class="mb-4"><span>Noticias</span> Recientes</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach ($eventos as $evento)
                    <div class="blog-container  col-sm-6 col-md-3">
                        <div class="blog-entry">
                            @php
                                if (strcmp($evento->image, 'defaultPicture.png') == 0) {
                                    $url = asset('images/' . $evento->image);
                                } else {
                                    $url = url('/storage/images/eventos/' . $evento->image);
                                }

                            @endphp
                            <a href="{{ route('eventos.show', $evento) }}" class="block-20 d-flex align-items-end"
                                style="background-image: url('{{ $url }}');">
                                <div class="meta-date text-center p-2">
                                    <?php
                                    date_default_timezone_set('America/Mexico_City');
                                    setlocale(LC_TIME, 'es_MX.UTF-8', 'esp');
                                    $date = new DateTime(explode(' ', $evento->fecha)[0]);
                                    $formatedDate = $date->getTimestamp();
                                    echo '<span class="day">' .
                                        strftime('%d', $formatedDate) .
                                        '</span>
                                                                                                        <span class="mos">' .
                                        ucfirst(substr(strftime('%B', $formatedDate), 0, 3)) .
                                        '</span>
                                                                                                        <span class="yr">' .
                                        strftime('%Y', $formatedDate) .
                                        '</span>                              
                                                                                                        ';
                                    ?>
                                </div>
                            </a>
                            <div class="text bg-white p-4">
                                <h1 class="heading  text-center border-bottom pb-3 mb-3"><a
                                        href="{{ route('eventos.show', $evento) }}"><b>{{ substr($evento->titulo, 0, 109) }}</b></a>
                                </h1>
                                <div class="description-news pt-2 mt-2">
                                    <p> {!! strip_tags($evento->descripcion) !!}</p>
                                </div>
                                <div class="d-flex align-items-center mt-4">
                                    <p class="mb-0"><a href="{{ route('eventos.show', $evento) }}"
                                            class="btn btn-info">Leer más<span
                                                class="ion-ios-arrow-round-forward"></span></a></p>
                                </div>
                            </div>

                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
    <div class="main">
        <section class="module" id="quienes-somos">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <h2 class="module-title font-alt">Quiénes somos</h2>
                    </div>
                </div>
                <div class="row multi-columns-row">
                    <div class="col-md-12">
                        <div class="features-item">
                            @foreach ($secciones as $seccion)
                                @if ($seccion->icono)
                                    <div class="features-icon text-center"><span class="{{ $seccion->icono }}"></span></div>
                                @endif
                                <h3 class="features-title font-alt text-center">{!! $seccion->titulo !!}</h3>
                                <p>
                                    {!! $seccion->contenido !!}
                                </p>
                            @endforeach
                            <h3 class="features-title font-alt text-center">Extensión</h3>
                            <div class="somos-extension container">
                                <div class="row justify-content-center">
                                    <div class="extension-element col-md-6 col-lg-3">
                                        <a target="_blank" href="https://www.facebook.com/ObserVamos"
                                            class="extension-container bg-extension2"
                                            style="background-image: url('{{ asset('/images/observatorio.jpg') }}');">

                                        </a>
                                    </div>

                                    <div class="extension-element col-md-6 col-lg-3">
                                        <a target="_blank" href="http://cmarti.cucsh.udg.mx/"
                                            class="extension-container bg-extension1">
                                            <div>
                                                <img src="{{ asset('images/martiheader_0.jpg') }}" />
                                                <p>Cátedra José Martí</p>
                                            </div>
                                        </a>
                                    </div>


                                    <div class="extension-element col-md-6 col-lg-3">
                                        <a style="background-size:cover; justify-content: flex-end; background-image: url('{{ asset('/images/catalogo.jpg') }}');"
                                            class="extension-container bg-extension2" target="_blank"
                                            href="https://docs.google.com/spreadsheets/d/1IMWvKkySg5aHb3dfXgQj-F7HJ1Cdw8qj/edit#gid=498495349">
                                            <div style="color:white; width: 100%; background:rgba(0,0,0,0.7); padding:10px;">
                                                <p class="m-0">Catálogo de biblioteca</p>
                                            </div>
                                        </a>

                                    </div>

                                    <div class="extension-element col-md-6 col-lg-3">
                                        <a style="display:flex; justify-content: center;background:rgba(90, 62, 20, 0.7);"
                                            class="extension-container bg-extension2" target="_blank"
                                            href="http://sepech.cucsh.udg.mx/">
                                            <div
                                                style="color:white; width: 100%;  padding:10px;">
                                                <p class="m-0"><img src="{{ asset('/images/sepech.svg') }}"
                                                        alt=""></p>
                                            </div>
                                        </a>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="module pb-0" id="investigadores">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <h2 class="module-title font-alt">Investigadores</h2>
                        <div class="module-subtitle font-serif"></div>
                    </div>
                </div>
            </div>
            <div class="container investigadores">
                @foreach ($investigadores as $investigador)
                    <div class="investigador-card w-30">
                        <div class="img-border-rounded">
                            @if (Storage::disk('images-investigadores')->has($investigador->image))
                                <img src="{{ url('/storage/images/investigadores/' . $investigador->image) }}" />
                            @endif

                        </div>
                        <div class="investigadores-card--info">
                            <h4>{{ $investigador->nombre . ' ' . $investigador->apellido }}</h4>
                            <h5>{{ $investigador->grado }}</h5>
                            <h6>Linea de investigación: <i>{{ substr($investigador->lineasInves, 0, 63) . '...' }}</i></h6>
                        </div>
                        <br>
                        <button type="button" class="btn btn-info btnModal" data-toggle="modal"
                            data-target="#modalInvest-{{ $investigador->id }}">Info</button>

                    </div>
                @endforeach
            </div>

        </section>

        <section class="module-small">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <button class="button1">
                            <a href="{{ route('investigadores.index') }}">
                                <span class="span1" style="font-size: 20px;">Ver más</span>
                                <div class="liquid1"></div>
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <section class="module" id="publicaciones">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 offset-sm-3">
                        <h2 class="module-title font-alt">Publicaciones</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-sm-20 wow fadeInUp col-sm-6 col-md-6">
                        <a href="{{ route('libros.index') }}" class="publicaciones-item bg-dark bg-gradient"
                            style='background-image: url("{{ asset('/images/libros.jpg') }}")'>
                            <p class="u-non-blurred">Libros y capítulos</p>
                        </a>
                    </div>
                    <div class="mb-sm-20 wow fadeInUp col-sm-6 col-md-6" onclick="wow fadeInUp">
                        <a href="{{ route('articulos.index') }}" class="publicaciones-item bg-dark bg-gradient"
                            style='background-image: url("{{ asset('/images/revistas.jpg') }}")'>
                            <p class="u-non-blurred">Artículos en revistas científicas</p>
                        </a>
                    </div>
                </div>
            </div>
        </section>


        <section class="module" id="divulgacion">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-12">
                        <h2 class="module-title font-alt">Divulgación</h2>

                    </div>
                    <div class="extension-element col-md-6 col-lg-3">
                        <a class="extension-container bg-extension2" target="_blank"
                            href="http://desmos.cucsh.udg.mx/eventos">
                            <div>
                                <img src="{{ asset('/images/banner-eventos.jpg') }}" />
                            </div>
                        </a>
                    </div>
                    <div class="extension-element col-md-6 col-lg-3">
                        <a class="extension-container bg-extension2" target="_blank"
                            href="https://m.youtube.com/channel/UC4Bt7XtTouqXqFTmztzBELA/featured">
                            <div>
                                <img src="{{ asset('/images/banner desmos youtube-02.jpg') }}" />
                            </div>
                        </a>
                    </div>


                </div>

                <div class="row multi-columns-row post-columns">
                    @foreach ($divulgaciones as $divulgacion)
                        <div class="col-sm-6 col-md-4 col-lg-4">
                            <div class="post mb-20">
                                <div class="video-responsive">
                                    @if (isset($divulgacion->link))
                                        @php
                                            if (str_contains($divulgacion->link, 'youtu.be/')) {
                                                $url =
                                                    'https://www.youtube.com/embed/' .
                                                    explode('youtu.be/', $divulgacion->link)[1];
                                            } else {
                                                $url = $divulgacion->link;
                                            }

                                        @endphp

                                        <iframe src="{{ $url }}" title="YouTube video player" frameborder="0"
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen></iframe>
                                    @else
                                        <img src="{{ asset('/images/desmosIcon.png') }}" alt="imagen-divulgacion"
                                            style="width: 100%;">
                                    @endif
                                </div>
                                <div class="post-header font-alt">
                                    <h2 class="post-title"><a
                                            href="{{ route('divulgaciones.show', $divulgacion->id) }}">{{ $divulgacion->titulo }}</a>
                                    </h2>

                                </div>
                                <div class="post-entry">
                                    <p>{!! strip_tags($divulgacion->descripcion) !!}</p>
                                </div>
                                <div class="post-more"><a class="more-link"
                                        href="{{ route('divulgaciones.show', $divulgacion->id) }}">Leer más</a></div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>
        <section class="module-small bg-transparent">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <button class="button1">
                            <a href="{{ route('divulgaciones.index') }}">
                                <span class="span1" style="font-size: 20px;">Ver más</span>
                                <div class="liquid1"></div>
                            </a>
                        </button>
                    </div>
                </div>
            </div>
        </section>
        <section id="contact">
            <img src="https://img.icons8.com/ios/50/FFFFFF/contact-card.png" />
            <h2 class="module-title font-alt">Contacto</h2>
            <div class="contact-container">
                @foreach ($contactos as $contacto)
                    <div class="contact-box">
                        <p><b>{{ $contacto->titulo }}</b></p>
                        <p>{{ $contacto->nombre }}</p>
                        @if ($contacto->correo)
                            <p>Correo: <a href="mailto:{{ $contacto->correo }}">{{ $contacto->correo }}</a></p>
                        @endif
                        @if ($contacto->telefono)
                            <p>Teléfono: <a href="tel:{{ $contacto->telefono }}">{{ $contacto->telefono }}</a></p>
                        @endif

                    </div>
                @endforeach
            </div>
        </section>
    @endsection

    @section('modal')
        {{-- Modal --}}
        @foreach ($investigadores as $investigador)
            <div class="modal fade" id={{ 'modalInvest-' . $investigador->id }}>
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div class="img-border-rounded">
                                @if (Storage::disk('images-investigadores')->has($investigador->image))
                                    <img src="{{ url('/storage/images/investigadores/' . $investigador->image) }}" />
                                @endif
                            </div>
                            <h1>{{ $investigador->nombre . ' ' . $investigador->apellido }}</h1><br>
                        </div>
                        <div class="modal-body">
                            <div class="informacionModal">
                                @if ($investigador->reconocimientos)
                                    <div class="modal-info--item">
                                        <b>Reconocimientos: </b> {{ $investigador->reconocimientos }}
                                    </div>
                                @endif
                                @if ($investigador->proyecto_invest)
                                    <div class="modal-info--item">
                                        <b>Proyecto de investigación en proceso: </b> {{ $investigador->proyecto_invest }}
                                    </div>
                                @endif
                                <div class="modal-info--item">
                                    <b>Publicaciones: </b>
                                    {{ $investigador->publicaciones }}
                                </div>
                                <div class="modal-info--item">
                                    <b>Contacto: </b>
                                    {{ $investigador->correo }}
                                </div>
                                <div class="modal-info--item">
                                    <b>Grado: </b>
                                    {{ $investigador->grado }}
                                </div>
                                <div class="modal-info--item">
                                    <b>Lineas de investigación: </b>
                                    {{ $investigador->lineasInves }}
                                </div>


                            </div>

                        </div>
                        <div class="modal-footer">
                            <input class="btn btn-primary" data-dismiss="modal" value="Cerrar">
                        </div>
                    </div>
                </div>

            </div>
        @endforeach
    @endsection

    @section('js')
        <script>
            function crearModal(idInvestigador) {


                document.getElementById('modalInvest').innerHTML = ;

            }
            document.getElementById('modalInvest').style = "display:inline";
        </script>
    @endsection
