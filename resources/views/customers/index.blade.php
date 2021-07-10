@extends('layouts.app')
@section('breadcrumb')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de Clientes</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Clientes</li>
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
                        <h3 class="card-title">Clientes</h3>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-info float-right" title="Agregar Cliente" href="{{ route('customers.create')}}">Nuevo</a>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered " id="dataTable">
                                <thead>
                                    <tr>
                                      <th class="table-dark">Nombre</th>
                                      <th class="table-dark">DUI</th>
                                      <th class="table-dark">Teléfono</th>
                                      <th class="table-dark">Email</th>
                                      <th class="table-dark">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($customers as $customer)
                                        <tr>
                                            <td>{{$customer->name}}</td>
                                            <td>{{$customer->dui}}</td>
                                            <td>{{$customer->phone}}</td>
                                            <td>{{$customer->email}}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a class="btn" title="Ver" href="{{ route('customers.show', $customer->id) }}"><i class="fas fa-eye"></i></a>
                                                    <a class="btn" title="Editar" href="{{ route('customers.edit', $customer->id) }}"><i class="fas fa-edit"></i></a>
                                                    <form method="POST" action="{{ route('customers.destroy', $customer->id) }}">
                                                      @csrf
                                                      @method('DELETE')
                                                      <button type="submit" title="Eliminar" onclick="return confirm('¿Desea eliminar el registro?')" class="btn btn-delete"><i class="fas fa-trash-alt"></i></button>
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
    </div>
@endsection
