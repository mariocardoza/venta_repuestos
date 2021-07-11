@extends('layouts.app')
@section('cabecera')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Agregar Venta</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item"><a href="{{ route('sales.index')}}">Ventas</a></li>
              <li class="breadcrumb-item active">Crear</li>
            </ol>
          </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Datos</h3>
                    </div>
                    <form method="POST" action="{{ route('sales.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        @include('sales.form')
                        <br>
                        <div class="text-center">
                          <button type="button" title="Agregar Venta" class="btn btn-info btn-accept" id="complete_sale">Guardar</button>
                          <a href="{{route('sales.index')}}" title="Cancelar y Regresar" class="btn btn-default btn-clear">Regresar</a>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="modal_aqui"></div>
    <!--- Modales -->
    <div class="modal fade" id="modal_repuesto" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header text-center">
            <h5 class="modal-title " id="exampleModalLabel">Repuestos
            </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="losrepuestos">
                <div class="card-body">
                <div class="row">
                  <div class="col-md-12">
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                          <label for="">Buscar repuesto</label>
                          <select name="" id="elselect_r" class="form-control">
                            <option value="">Seleccione</option>
                            @foreach($products as $product)
                                <option data-existencia="{{\App\Product::stock($product->id)}}" data-codigo="{{$product->code}}" data-precio="{{$product->price}}" value="{{$product->id}}">{{$product->name}}</option>
                            @endforeach
                          </select>
                          <input type="hidden" id="existencia">
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="">Código</label>
                          <input type="text" placeholder="" readonly="" class="form-control codir">
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">Precio (*)</label>
                                        <input type="number" id="n_precio_r" step="any" name="precio" class="form-control precio_r">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="" class="control-label">Cantidad (*)</label>
                                        <input type="number" value="1" id="n_cantidad_r" class="form-control cantidad_r">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="" class="control-label">Subtotal (*)</label>
                                <input type="number" readonly class="form-control subto_r">
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
          <div class="modal-footer">
            <div class="float-none">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                <button type="button" id="btn_agregar_repuesto" class="btn btn-success">Agregar</button>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection
@push('page_scripts')
<script>
    $(function(){
        $(document).on("click","#md_trabajos",function(e){
            e.preventDefault();
            $("#modal_repuesto").modal("show");
        });
        //eventro change para el repuesto
        $(document).on("change","#elselect_r",function(e){
            e.preventDefault();
            var id=$(this).val();
            var codigo=$('option:selected',this).attr("data-codigo");
            var precio=$('option:selected',this).attr("data-precio");
            var existencia=$('option:selected',this).attr("data-existencia");

            $("#n_precio_r").val(precio);
            $(".codir").val(codigo);
            $("#existencia").val(existencia);

            $(".precio_r").trigger("input");
            console.log(id);
            
        });

        //agregar un repuesto
        $(document).on("click","#btn_agregar_repuesto",function(e){
            var product_id=$("#elselect_r").val();
            var precio=$("#n_precio_r").val();
            var cantidad=$("#n_cantidad_r").val();
            var customer_id=$('#customer_id').val();
            var fecha=$(".fecha").val();
            var sale_id=$("#sale_id").val();
            var receipt_id=$("#receipt_type").val();
            var sale_date=$("#sale_date").val();
            var existencia = $("#existencia").val();
            if(cantidad > 0 && cantidad <= existencia){
                modal_cargando();
                $.ajax({
                    url:'/admin/sale_details',
                    type:'POST',
                    dataType:'json',
                    data:{product_id,precio,cantidad,customer_id,fecha,receipt_id,sale_id,sale_date},
                    success: function(json){
                        if(json[0]==1){
                            toastr.success("Repuesto aplicado con éxito");
                            $("#sale_id").val(json[2]);
                            obtenerprevias(json[2]);
                            swal.closeModal();
                            $(".cantidad_r").val(1);
                            $(".precio_r").val(0);
                            $(".codir").val("");
                            $("#elselect_r").val("");
                        }else{
                            swal.closeModal();
                            if(json[0]==2){
                                toastr.info(json[1]);
                            }else{
                                toastr.error("Ocurrió un error");
                            }
                        }
                    },
                    error: function(error){
                        swal.closeModal();
                        $.each(error.responseJSON.errors, function(i,v){
                            toastr.error(v);
                        });
                    }
                });
            }else{
                swal.fire(
                  'Aviso',
                  'La cantidad ingresada sobrepasa las existencias',
                  'warning'
                );
            }
        });

        // modal editar repuesto previo
        $(document).on("click","#editar_repuesto",function(e){
            e.preventDefault();
            var id=$(this).attr("data-id");
            $.ajax({
                url:'/admin/sale_details/'+id+'/edit',
                type:'get',
                dataType:'json',
                success: function(json){
                    if(json[0]==1){
                        $("#modal_aqui").empty();
                        $("#modal_aqui").html(json[2]);
                        $("#modal_repuesto_edit").modal("show");
                    }
                }
            });
        });

        //submit para el repuesto edit previa
        $(document).on("click","#edit_repuesto_previa",function(e){
            e.preventDefault();
            var id=$(this).attr("data-id");
            var sale_id=$("#sale_id").val();
            var datos=$("#form_repuesto_edit").serialize();
            var e_canti = $(".e_cantidad_r").val();
            var existencia = $("#e_existencia").val();
            if(e_canti > 0 && e_canti <= existencia){
                modal_cargando();
                $.ajax({
                    url:'/admin/sale_details/'+id,
                    type:'put',
                    dataType:'json',
                    data:datos+'&sale_id='+sale_id,
                    success: function(json){
                        if(json[0]==1){
                            toastr.success("Producto editado con éxito");
                            $("#form_repuesto_edit").trigger("reset");
                            $("#modal_repuesto_edit").modal("hide");
                            obtenerprevias(json[2]);
                            swal.closeModal();
                        }else{
                            toastr.error("Ocurrió un error");
                            swal.closeModal();
                        }
                    },
                    error: function(error){
                        $.each(error.responseJSON.errors,function(index,value){
                            toastr.error(value);
                        });
                        swal.closeModal();
                    }
                });
            }else{
                swal.fire(
                  'Aviso',
                  'La cantidad ingresada sobrepasa las existencias',
                  'warning'
                );
            }
        });

        //eliminar un repuesto
        $(document).on("click","#eliminar_repuesto",function(e){
            e.preventDefault();
            var id=$(this).attr("data-id");
            var sale_id=$("#sale_id").val();
            swal.fire({
              title: '¿Eliminar?',
              text: "¿Está seguro de eliminar el producto de la venta?",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Si'
            }).then((result) => {
              if (result.value) {
                modal_cargando();
                $.ajax({
                    url:'/admin/sale_details/'+id,
                    type:'DELETE',
                    dataType:'json',
                    data:{sale_id},
                    success: function(json){
                        if(json[0]==1){
                            toastr.success("Producto eliminado con éxito");
                            swal.closeModal();
                            $("#sale_id").val(json[2]);
                            obtenerprevias(json[2]);
                        }else{
                            toastr.error("Ocurrió un error");
                            swal.closeModal();
                        }
                    }
                });
              }
            });
            
        });
        $(document).on("input",".precio_r,.cantidad_r",function(e){
            e.preventDefault();
            var precio=parseFloat($(".precio_r").val());
            var cantidad=parseInt($(".cantidad_r").val());
            var subto=precio*cantidad;
            $(".subto_r").val(subto);
        });

        $(document).on("input",".e_precio_r,.e_cantidad_r",function(e){
            e.preventDefault();
            var precio=parseFloat($(".e_precio_r").val());
            var cantidad=parseInt($(".e_cantidad_r").val());
            var subto=precio*cantidad;
            $(".e_subto_r").val(subto);
        });

        /* completar venta */
        $(document).on("click","#complete_sale",function(e){
            e.preventDefault();
            var sale_id = $("#sale_id").val();
            alert(sale_id);
            if(sale_id==0){
                location.href="/admin/sales";
            }else{
                $.ajax({
                    url:'/admin/sales',
                    type:'post',
                    dataType:'json',
                    data:{sale_id},
                    success:function(json){
                        if(json[0]==1){
                            toastr.success('Factura guardada con éxito');
                            location.href='/admin/sales/'+json[2];
                        }else{
                            toastr.error("Ocurrió un error");
                            swal.closeModal(); 
                        }
                    },
                    error: function(error){
                        toastr.error("Ocurrió un error");
                        swal.closeModal();
                    }
                });
            }
        });
    });

    function obtenerprevias(id){
        $.ajax({
            url:'/admin/sales/preview/'+id,
            type:'get',
            dataType:'json',
            success: function(json){
                if(json[0]==1){
                    $("#tabita>tbody").empty();
                    $("#tabita>tbody").html(json[2]);
                    $("#tabita>tfoot").html(json[3]);
                }
            }
        });
    }
</script>
@endpush
