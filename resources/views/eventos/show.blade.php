@extends('layouts.plantilla')

@section('content')
    <div class="container py-5 container-individual-pages">
        <div class="row">
            <div class="col-md-12">
                <h1 class="text-center">{{$evento->titulo}}</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div>
                    {!!$evento->descripcion!!}
                    
                </div>
            </div>
            <div class="col-md-4">
                <a href="#" data-toggle="modal" data-target="#exampleModal">
@if(strcmp($evento->image,'defaultPicture.png')==0)
 <img src="{{asset('images/'.$evento->image)}}"/>
@else
 <img src="{{url('/storage/images/eventos/'.$evento->image)}}"/>
@endif
                   
                </a>
            </div>
            <div class="col-md-12">
                @if($archivos->isNotEmpty())
                    <h5><b>Archivos adjuntos</b></h5>
                @endif
                @foreach($archivos as $archivo)
                        <div class="file mb-1">
                            <a target="_blank" href="{{url('storage/files/'.$archivo->path)}}">{{$archivo->path}}</a>
                        </div>

                @endforeach
            </div>
        </div>

    </div>
    @endsection


@section('modal')
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <img src="{{url('/storage/images/eventos/'.$evento->image)}}">
        </div>
      </div>
    </div>
</div>
@endsection