@extends('layouts.app')
@section('cabecera')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Agregar productos a la compra</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{ route('purchases.index')}}">Compras</a></li>
              <li class="breadcrumb-item"><a href="{{ route('purchases.edit',$purchase->id)}}">Compra factura N°: {{$purchase->bill_number}}</a></li>
              <li class="breadcrumb-item active">Agregar producto</li>
            </ol>
          </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Detalle de la compra</h3>
                    </div>
                    <form method="POST" action="{{ route('purchase-detail.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include('purchases.detail.form')
                        <br>
                        <div class="text-center">
                          <button type="submit" title="Agregar Compra" class="btn btn-info btn-accept">Agregar</button>
                          <a href="{{route('purchases.index')}}" title="Cancelar y Regresar" class="btn btn-default btn-clear">Regresar</a>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
