@extends('layouts.app')
@section('cabecera')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Agregar Proveedores</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{ route('customers.index')}}">Proveedores</a></li>
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
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Datos</h3>
                    </div>
                    <form method="POST" action="{{ route('customers.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include('customers.form')
                        <br>
                        <div class="text-center">
                          <button type="submit" title="Agregar Proveedor" class="btn btn-info btn-accept">Agregar</button>
                          <a href="{{route('customers.index')}}" title="Cancelar y Regresar" class="btn btn-default btn-clear">Regresar</a>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
