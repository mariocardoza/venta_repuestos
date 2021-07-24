@extends('layouts.app')
@section('cabecera')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Datos de la Venta</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{ route('sales.index')}}">Ventas</a></li>
            </ol>
          </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Información del Cliente</h3>
                    </div>
                    <form method="POST" action="{{ route('sales.update', $sale->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PATCH')
                        <table class="table">
                          <tr>
                            <th>Nombre</th>
                            <td>{{ $sale->customer_id != 0 ? $sale->customer->name : "Sin cliente registrado" }}</td>
                          </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3 class="text-center">Productos vendidos</h3>
            </div>
            <div class="col-md-10">
                <br>
                <div class="card table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="table-secondary">N°</th>
                                <th class="table-secondary">Código</th>
                                <th class="table-secondary">Precio</th>
                                <th class="table-secondary">Cantidad</th>
                                <th class="table-secondary">Total</th>

                            </trsecondary>                       
                        </thead>
                        <tbody>
                            @foreach($sale->detail as $index => $detail)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$detail->product->code}}</td>
                                    <td>${{$detail->price}}</td>
                                    <td>{{$detail->amount}}</td>
                                    <td>${{$detail->amount*$detail->price}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="text-center">
                    <a target="_blank" href="{{ url("/admin/sales/pdf/".$sale->id) }}" title="Imprimir venta" class="btn btn-info btn-accept" id="">Imprimir</a>
                </div>
            </div>
        </div>
    </div>
@endsection
