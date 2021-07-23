@extends('layouts.app')
@section('breadcrumb')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de usuarios</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Usuarios</li>
            </ol>
          </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Registro de actividades</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable">
                                <thead>
                                    <tr>
                                        <th class="text-center table-secondary">#</th>
                                        <th class="text-center table-secondary">Acción</th>
                                        <th class="text-center table-secondary">Url</th>
                                        <th class="text-center table-secondary">Usuario</th>
                                        <th class="text-center table-secondary">Fecha actividad</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @foreach($logs as $i => $log)
                                        <tr id="row_{{ $log->id }}">
                                            <td>{{ $i+1 }}</td>
                                            <td class="text-center">{{ $log->subject }}</td>
                                            <td class="text-center">{{ $log->url }}</td>
                                            <td class="text-center">{{ $log->user->name }}</td>
                                            <td class="text-center">{{ date('d-m-Y H:i:s', strtotime($log->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
