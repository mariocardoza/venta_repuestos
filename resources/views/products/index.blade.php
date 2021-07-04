@extends('layouts.app')
@section('breadcrumb')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Listado de productos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Productos</li>
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
                        <h3 class="card-title">Productos</h3>
                    </div>
                    <div class="card-body">
                        <a class="btn btn-info float-right" title="Agregar Producto" href="{{ route('products.create')}}">Nuevo</a>
                        <br>
                        <table class="table table-bordered " id="dataTable">
                            <thead>
                                <tr>
                                  <th>Código</th>
                                  <th>Nombre del producto</th>
                                  <th>Precio</th>
                                  <th>Imagen</th>
                                  <th>Stock</th>
                                  <th class="text-center">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->code}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->price}}</td>
                                        <td><img height="150" width="150" class="img-fluid" src="{{ $product->image!='' ? $product->url_image : asset('images/no-disponible.jpg')}}"></td>
                                        <td>{{\App\Product::stock($product->id)}}</td>
                                        <td class="text-center">
                                            <div class="btn-group">
                                                <a class="btn" title="Ver" href="{{ route('products.show', $product->id) }}"><i class="fas fa-eye"></i></a>
                                                <a class="btn" title="Editar" href="{{ route('products.edit', $product->id) }}"><i class="fas fa-edit"></i></a>
                                                <form method="POST" action="{{ route('products.destroy', $product->id) }}">
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
