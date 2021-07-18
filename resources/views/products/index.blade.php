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
                        <div class="table-responsive">
                            <table class="table table-bordered " id="dataTable">
                                <thead>
                                    <tr>
                                      <th class="table-secondary">Código</th>
                                      <th class="table-secondary">Nombre del producto</th>
                                      <th class="table-secondary">Precio</th>
                                      <th class="table-secondary">Marca</th>
                                      <th class="table-secondary">Modelo</th>
                                      <th class="table-secondary">Número motor</th>
                                      <th class="table-secondary">Imagen</th>
                                      <th class="table-secondary">Stock</th>
                                      <th  class="table-secondary text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr>
                                            <td>{{$product->code}}</td>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>{{$product->category_id!='' ? $product->category->name : 'ninguno'}}</td>
                                            <td>{{ $product->subcategory_id!='' ? $product->subcategory->name : 'ninguno'}}</td>
                                            <td>{{$product->engine_number}}</td>
                                            <td><img height="100" width="100" class="img-fluid" src="{{ $product->image!='' ? $product->url_image : asset('images/no-disponible.jpg')}}"></td>
                                            <td>{{\App\Product::stock($product->id)}}</td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a class="btn" title="Editar" href="{{ route('products.edit', $product->id) }}"><i class="fas fa-edit"></i></a>
                                                    <button type="button" id="del-product" data-id="{{ $product->id }}" title="Eliminar" class="btn btn-delete"><i class="fas fa-trash-alt"></i></button>
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
    <div class="modal fade" data-backdrop="static" data-keyboard="false" id="modal_autizacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title" id="myModalLabel">Formulario de autorización por el administrador</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" id="form_autorizacion">              
                        <div class="form-group">
                            <label for="" class="control-label">Digite el nombre de usuario</label>
                            <div class="">
                                <input type="text" id="el_username" name="username" class="form-control">
                                <input type="hidden" name="elid" id="elid">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="control-label">
                                  Contraseña
                            </label>
                            <div>
                                <input type="password" id="el_password" name="password" class="form-control">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <center><button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    <button type="button" id="autorizacion_del" class="btn btn-success">Confirmar</button></center>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('page_scripts')
<script>
    $(function(){
        //eliminar producto
        $(document).on("click","#del-product",function(e){
            e.preventDefault();
            let id = $(this).attr('data-id');
            //let confirmed = confirm("¿Desea eliminar el producto?");
            //if (confirmed == true) {
            $("#modal_autizacion").modal("show");
            $("#elid").val(id);
            //}
        });
        //autorización para eliminar producto 
        $(document).on("click","#autorizacion_del", function(e){
          swal.fire({
            title: 'Buscando en la base de datos!',
            text: 'Este diálogo se cerrará al completar la operación.',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            onOpen: function () {
              swal.showLoading()
            }
          });
          e.preventDefault();
          var username = $("#el_username").val();
          var password = $("#el_password").val();
          var elid = $("#elid").val();
          $.ajax({
            url:'/admin/autorizacion',
            type:'post',
            dataType:'json',
            data:{username, password,elid},
            success: function(json){
              swal.closeModal();
              if(json[0]==1){
                
                if(json[2]==1){
                  toastr.success("Usuario correcto");
                  $("#modal_autizacion").modal("hide");
                  $("#form_autorizacion").trigger("reset");
                  $.ajax({
                    url:'/admin/products/'+json[3],
                    type:'delete',
                    dataType:'json',
                    success: function(json){
                        if(json[0]==1){
                            toastr.success('Eliminado con éxito');
                            location.reload();
                        }else{
                            toastr.error('Ocurrió un error, contacte al administrador');
                        }
                    },error: function(error){
                        toastr.error('Ocurrió un error, contacte al administrador');
                    }
                  });
                  swal.closeModal();
                }else{
                  toastr.info("El Usuario ingresado no es administrador");
                  swal.closeModal();
                }
                swal.closeModal();
              }else{
                toastr.error("El nombre de usuario o la contraseña son erróneos");
                swal.closeModal();
              }
            },
            error: function(error){
              console.log(error);
              $.each(error.responseJSON.errors, function( key, value ) {
                toastr.error(value);
              });
              swal.closeModal();
            }
          });
        });
    });
</script>
@endpush
