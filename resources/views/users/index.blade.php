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
                        <h3 class="card-title">Usuarios</h3>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-info float-right" href="{{ route('users.create')}}">Nuevo</a>
                        <br>
                        <table class="table table-bordered datatables">
                            <thead>
                                <tr>
                                  <th>Nombre completo</th>
                                  <th>Correo electrónico</th>
                                  <th>Nombre de usuario</th>
                                  <th>Teléfono</th>
                                  <th>Rol</th>
                                  <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->username}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->phone}}</td>
                                        <td>{{$user->role->name}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a class="btn" href="{{ route('users.edit', $user->id) }}"><i class="fas fa-edit"></i></a>
                                                <form method="POST" action="{{ route('users.destroy', $user->id) }}">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" onclick="return confirm('¿Desea eliminar el usuario?')" class="btn btn-delete"><i class="fas fa-trash-alt"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
