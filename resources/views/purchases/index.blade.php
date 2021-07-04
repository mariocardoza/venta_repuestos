@extends('layouts.app')
@section('breadcrumb')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de Compras</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Compras</li>
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
                        <h3 class="card-title">Compras</h3>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-info float-right" title="Agregar Compra" href="{{ route('purchases.create')}}">Nueva</a>
                        <br>
                        <table class="table table-bordered " id="dataTable">
                            <thead>
                                <tr>
                                  <th>Proveedor</th>
                                  <th>Total</th>
                                  <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($purchases as $purchase)
                                    <tr>
                                        <td>{{$purchase->supplier}}</td>
                                        <td>${{$purchase->total}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a class="btn" title="Ver" href="{{ route('purchases.show', $purchase->id) }}"><i class="fas fa-eye"></i></a>
                                                <a class="btn" title="Editar" href="{{ route('purchases.edit', $purchase->id) }}"><i class="fas fa-edit"></i></a>
                                                <form method="POST" action="{{ route('purchases.destroy', $purchase->id) }}">
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
@endsection
