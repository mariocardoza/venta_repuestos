@extends('layouts.app')
@section('breadcrumb')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar usuario</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{ route('users.index')}}">Usuarios</a></li>
              <li class="breadcrumb-item active">Editar</li>
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
                        <h3 class="card-title">Productos</h3>
                    </div>
                    <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PATCH')
                        @include('users.form')
                        <br>
                        <div class="text-center">
                          <button type="submit" class="btn btn-info btn-accept">Editar usuario</button>
                          <a href="{{route('users.index')}}" class="btn btn-default btn-clear">Regresar</a>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
