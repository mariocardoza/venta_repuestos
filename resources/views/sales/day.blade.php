@extends('layouts.app')
@section('cabecera')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de ventas del día</h1>
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
                        <form action="{{ route('sales.day')}}" method="GET">
                            <div class="row">

                                <div class="col-4">
                                    <div class="form-group">
                                        <input name="fecha" placeholder="Seleccione una fecha" type="text" autocomplete="off" class="form-control fechita">
                                    </div>
                                </div>
                                <div class="col-4 justify-content-center">
                                    <button type="submit" class="btn btn-info">Buscar</button>
                                </div>
                            </div>
                        </form>
                        <a class="btn btn-info float-right" title="Agregar Venta" href="{{ route('sales.create')}}">Nuevo</a>
                        <a target="_blank" class="btn btn-info float-left" title="Imprimir reporte" href="{{ route('sales.dayly')}}">Imprimir</a>
                        <br><br>
                        <table class="table table-bordered " id="dataTable">
                            <thead>
                                <tr>
                                  <th>Cliente</th>
                                  <th>Fecha Venta</th>
                                  <th>Total</th>

                                  <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($sales as $sale)
                                    <tr>
                                        <td>{{$sale->customer->name}}</td>
                                        <td>{{$sale->sale_date->format('d/m/Y')}}</td>
                                        <td>${{number_format($sale->total,2)}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a class="btn" title="Ver" href="{{ route('sales.show', $sale->id) }}"><i class="fas fa-eye"></i></a>
                                                <!--a class="btn" title="Editar" href="{{ route('sales.edit', $sale->id) }}"><i class="fas fa-edit"></i></a-->
                                        
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
