@extends('layouts.app')
@section('cabecera')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Editar Compra</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{ route('purchases.index')}}">Compras</a></li>
              <li class="breadcrumb-item active">Crear</li>
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
                        <h3 class="card-title">Compras</h3>
                    </div>
                    <form method="POST" action="{{ route('purchases.update', $purchase->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @method('PATCH')
                        @include('purchases.form')
                        <br>
                        <div class="text-center">
                          <button type="submit" class="btn btn-info btn-accept">Editar Compra</button>
                          <a href="{{route('purchases.index')}}" class="btn btn-default btn-clear">Regresar</a>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
        <br>
        <div class="row justify-content-center">
            <div class="col-md-10">
                <h3 class="text-center">Productos en la compra</h3>
            </div>
            <div class="col-md-10">
                <a href="{{url('admin/purchase-detail/create?purchase_id='.$purchase->id)}}" class="btn btn-info" type="button">Agregar productos</a>
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
                                <th class="table-secondary">Acciones</th>
                            </trsecondary                        </thead>
                        <tbody>
                            @foreach($purchase->detail as $index => $detail)
                                <tr>
                                    <td>{{$index+1}}</td>
                                    <td>{{$detail->product->code}}</td>
                                    <td>{{$detail->product->name}}</td>
                                    <td>${{$detail->price}}</td>
                                    <td>{{$detail->quantity}}</td>
                                    <td>${{$detail->quantity*$detail->price}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <a class="btn" title="Editar" href="{{ url('admin/purchase-detail/'.$detail->id.'/edit?purchase_id='.$purchase->id) }}"><i class="fas fa-edit"></i></a>
                                            <form method="POST" action="{{ route('purchase-detail.destroy', $detail->id) }}">
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
@endsection
