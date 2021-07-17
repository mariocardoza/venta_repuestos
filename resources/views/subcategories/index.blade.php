@extends('layouts.app')
@section('breadcrumb')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de Marcas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Marcas</li>
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
                        <h3 class="card-title">Marcas</h3>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-info float-right" title="Agregar Marca" href="{{ route('subcategories.create')}}">Nuevo</a>
                        <br>
                        <div class="table-responsive">
                            <table class="table table-bordered " id="dataTable">
                                <thead>
                                    <tr>
                                      <th class="table-secondary">Modelo</th>
                                      <th class="table-secondary">Marca</th>
                                      <th class="table-secondary">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($subcategories as $subcategory)
                                        <tr>
                                            <td>{{$subcategory->name}}</td>
                                            <td>{{$subcategory->category->name}}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a class="btn" title="Editar" href="{{ route('subcategories.edit', $subcategory->id) }}"><i class="fas fa-edit"></i></a>
                                                    <form method="POST" action="{{ route('subcategories.destroy', $subcategory->id) }}">
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
