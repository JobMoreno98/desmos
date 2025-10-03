@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container">
            <div class="row align-items-center">
                @if (Auth::check() && Auth::user()->rol == 'admin')
                    <div class="col-md-12 ">
                @endif

                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 text-center mb-5 mt-2">
                            <h2 class="display-5 fw-bold mb-3">{{ config('app.name', 'Laravel') }}</h2>
                        </div>
                    </div>

                    <div class="row g-4">
                        @foreach ($coleccion as $key => $value)
                            <div class="col-md-4">
                                <div class="service-card h-100 p-4">
                                    <div class="d-flex justify-content-start align-items-center">
                                        <div class="icon-wrapper mb-4 me-1 text-white fs-4 ">
                                            <span class="material-symbols-outlined icon">{{ $value['icon'] }} </span>
                                        </div>
                                        <h4 class="service-title text-center mb-3">{{ $value['titulo'] }}</h4>
                                    </div>
                                    <p class="service-text text-center mb-0">
                                        <a href="{{ $value['enlaces']['consultar'] }}"
                                            class="btn btn-sm btn-outline-success mb-2">{{ 'Consultar ' . $value['titulo'] }}</a>
                                        <a href="{{ $value['enlaces']['crear'] }}"
                                            class="btn btn-sm btn-outline-danger mb-2">{{ 'Crear ' . $value['titulo'] }}</a>
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
