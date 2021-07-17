@extends('layouts.app')
@section('cabecera')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Agregar Marcas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{ route('categories.index')}}">Marcas</a></li>
              <li class="breadcrumb-item active">Crear</li>
            </ol>
          </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Datos</h3>
                    </div>
                    <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include('categories.form')
                        <br>
                        <div class="text-center">
                          <button type="submit" title="Agregar Marca" class="btn btn-info btn-accept">Guardar</button>
                          <a href="{{route('categories.index')}}" title="Cancelar y Regresar" class="btn btn-default btn-clear">Regresar</a>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
