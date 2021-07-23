@extends('layouts.app')
@section('cabecera')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{ route('purchases.index')}}">Compras</a></li>
            </ol>
          </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection
@section('content')
    <div class="container-fluid">
        <br>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3 class="text-center">Productos Adquiridos</h3>
            </div>
            <div class="col-md-10">
                <br>
                <br>
                <div class="card table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="table-secondary">N°</th>
                                <th class="table-secondary">Código</th>
                                <th class="table-secondary">Producto</th>
                                <th class="table-secondary">Precio</th>
                                <th class="table-secondary">Cantidad</th>
                                <th class="table-secondary">Total</th>
                            </trsecondary>
                            </thead>
                        <tbody>
                            @foreach($purchase->detail as $index => $detail)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$detail->product->code}}</td>
                                    <td>{{$detail->product->name}}</td>
                                    <td>${{$detail->price}}</td>
                                    <td>{{$detail->quantity}}</td>
                                    <td>${{$detail->quantity*$detail->price}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <a class="btn btn-warning float-center" title="Editar" href="{{ route('purchases.edit', $purchase->id) }}">Editar Compra</a>
            </div>
        </div>
    </div>
@endsection
