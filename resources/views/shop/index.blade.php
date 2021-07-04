@extends('layouts.app')

@section('breadcrumb')
<div class="container-fluid">
  <div class="row mb-2">
    <div class="col-sm-6">
      <h1 class="m-0 text-dark">Administración</h1>
    </div><!-- /.col -->
    <div class="col-sm-6">
      <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{url('home')}}">Inicio</a></li>
        <li class="breadcrumb-item active">Administración</li>
      </ol>
    </div><!-- /.col -->
  </div><!-- /.row -->
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-3">
			<div class="card card-primary">
				<div class="card-body">
					<p>
            Esta sección es para modificar información básica del negocio como pueden ser: la direccion, los números de teléfono o los porcentajes de IVA y Renta.
          </p>
				</div>
			</div>
    </div>
    <div class="col-md-9">
        <div class="card ">
          <div class="card-header p-2">
            <ul class="nav nav-pills">
              <li class="nav-item"><a class="nav-link active" href="#alcaldia" data-toggle="tab">Datos de negocio</a></li>
              <li class="nav-item"><a class="nav-link" href="#porcentajes" data-toggle="tab">Porcentajes</a></li>
            </ul>
          </div><!-- /.card-header -->
          <div class="card-body">              
              <div class="tab-content">
                <div class="active tab-pane" id="alcaldia" >
                  <div class="panel">
                    <div class="panel-body">
                      <form id="form_shop">
                        <input type="hidden" name="id" value="{{$shop->id}}">
                        <div class="form-group row">
                          <div class="col-md-12">
                            <label>Adjunte logo para el negocio</label>
                            <input id="logo" type="file" class="form-control @error('logo') is-invalid @enderror" name="logo" value="" placeholder="Seleccionar logo" title="Seleccione logo">
                            <p class="info-text">Formatos permitidos: png. Dimensión 100x100px. Máx: 2mb.</p>
                            <span class="invalid-inputs" id="error_logo" role="alert"><strong></strong></span>
                            <div class="logo-form text-center"><img src="{{ $shop->logo=='' ? asset('images/no-disponible.jpg') : $shop->logo }}" height="100" alt=""></div>
                          </div>
                        </div>

                        <div class="form-group row">
                          <div class="col-md-6">
                            <label for="" class="control-label">Nombre del negocio</label>
                            <input type="text" class="form-control" name="shop_name" value="{{$shop->shop_name}}">
                          </div>
                          <div class="col-md-6">
                            <label for="" class="control-label">Razon social</label>
                            <input type="text" class="form-control" name="business_name" value="{{$shop->business_name}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-6">
                            <label for="" class="control-label">Representante legal</label>
                            <input type="text" class="form-control" name="owner" value="{{$shop->owner}}">
                          </div>
                          <div class="col-md-6">
                            <div class="form-group">
                              <label for="" class="control-label">Correo electrónico del negocio</label>
                              <input type="email" class="form-control" name="email" value="{{$shop->email}}">
                          </div>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-12">
                            <label for="" class="control-label">Dirección</label>
                            <textarea name="address" id="" rows="2" class="form-control">{{$shop->address}}</textarea>
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-6">
                            <label for="" class="control-label">Teléfono 1</label>
                            <input type="text" name="phone" class="form-control phone" value="{{$shop->phone}}">
                          </div>
                          <div class="col-md-6">
                            <label for="" class="control-label">Teléfono 2</label>
                            <input type="text" name="phone2" class="form-control phone" value="{{$shop->phone2}}">
                          </div>
                        </div>
                        <div class="form-group row">
                          <div class="col-md-6">
                            <label for="" class="control-label">NIT</label>
                            <input type="text" name="nit" class="form-control nit" value="{{$shop->nit}}">
                          </div>
                          <div class="col-md-6">
                            <label for="" class="control-label">NRC</label>
                            <input type="number" name="nrc" class="form-control" value="{{$shop->nrc}}">
                          </div>
                        </div>
                        <br><br>
                        <div class="form-group row">
                          <button class="btn btn-success m-auto" type="submit">Guardar</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
                <!-- /.tab-pane -->

                <div class="tab-pane" id="porcentajes">
                  <div class="panel">
                    <div class="panel-body">
                      <div class="row">
                        @foreach($percentages as $p)
                        <div class="col-md-3">
                          <label for="" class="control-label">% {{$p->nombre}}</label>
                          <div class="input-group">
                            <input type="number" min="0" value="{{$p->porcentaje}}"  name="porcentaje" class="form-control {{$p->nombre_simple}}">
                            <span class="input-group-btn">
                              <button type="button" data-porcen="{{$p->nombre_simple}}" data-id="{{$p->id}}" class="btn btn-success porcen"><i class="fas fa-sync"></i></button>
                            </span>
                          </div>
                        </div>
                        @endforeach 
                      </div>
                    </div>
                  </div>
                </div>

               
                
                <!-- /.tab-pane -->
              </div>
          </div>
        </div>
    </div>
	</div>
</div>
@endsection
@push('page_scripts')
<script type="text/javascript">
  $(function(){
    swal.closeModal();
    //Guardar o editar shop
    $(document).on("submit","#form_shop",function(e){
      e.preventDefault();
      e.preventDefault();
      var form = $('#form_shop');
      var formData = new FormData(form[0]);

      modal_cargando();
      $.ajax({
        url:'/admin/shop',
        type:'post',
        dataType:'json',
        data:formData,
        cache: false,
        contentType: false,
        processData: false,

        success: function(json){
          if(json[0]==1){
            toastr.success("Datos modificados con éxito");
            location.reload();
          }else{
            toastr.error("Ocurrió un error, intente otra vez");
            swal.closeModal();
          }
        },error: function(e){
          toastr.error("Ocurrió un error, intente otra vez");
          swal.closeModal();
        }
      });
    });
    ///cambiar el porcentaje
    $(document).on("click",".porcen",function(e){
      e.preventDefault();
      var id=$(this).attr("data-id");
      var input=$(this).attr("data-porcen");
      var elvalor=$("."+input).val();
      modal_cargando();
      $.ajax({
        url:'/admin/shop/percentages',
        type:'POST',
        dataType:'json',
        data:{id,porcentaje:elvalor},
        success: function(json){
          if(json[0]==1){
            toastr.success("Porcentaje actualizado con éxito");
            //location.reload();
            swal.closeModal();
          }else{
            swal.closeModal();
            toastr.error("Ocurrió un error");
          }
        },
        error: function(error){
          swal.closeModal();
        }
      });
    });
  });
</script>
@endpush