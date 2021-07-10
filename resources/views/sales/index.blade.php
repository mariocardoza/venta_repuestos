@extends('layouts.app')
@section('breadcrumb')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de Ventas</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Ventas</li>
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
                        <h3 class="card-title">Ventas</h3>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-info float-right" title="Agregar Venta" href="{{ route('sales.create')}}">Nuevo</a>
                        <br>
                        <table class="table table-bordered " id="dataTable">
                            <thead>
                                <tr>
                                  <th>Comprador</th>
                                  <th>Fecha Venta</th>
                                  <th>Total</th>

                                  <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $sale)
                                    <tr>
                                        <td>{{$sale->customer_id}}</td>
                                        <td>{{$sale->sale_date}}</td>
                                        <td>{{$sale->total}}</td>
                                        <td><img height="150" width="150" class="img-fluid" src="{{ $sale->image!='' ? $product->url_image : asset('images/no-disponible.jpg')}}"></td>
                                        <td>{{\App\Sale::stock($sale->id)}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a class="btn" title="Ver" href="{{ route('sales.show', $sale->id) }}"><i class="fas fa-eye"></i></a>
                                                <a class="btn" title="Editar" href="{{ route('sales.edit', $sale->id) }}"><i class="fas fa-edit"></i></a>
                                                <form method="POST" action="{{ route('sales.destroy', $sale->id) }}">
                                                  @csrf
                                                  @method('DELETE')
                                                  <button type="submit" title="Eliminar" onclick="return confirm('¿Desea eliminar el proyecto?')" class="btn btn-delete"><i class="fas fa-trash-alt"></i></button>
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
