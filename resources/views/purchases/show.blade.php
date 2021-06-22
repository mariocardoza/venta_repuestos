@extends('layouts.app') 
@section('content')
<div style="width: 100%;">
  <div class="row">
    <div class="col-lg-12">
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Datos de Compras</h3>
        </div>
        <form action="#" id="formulario" name="formulario">
          <div class="box-body">
            <div class="form-group col-sm-7">
              <label for="supplier">Proveedor</label>
                <h4>{{ $purchase->supplier }}</h4> 
            </div>
            <div class="form-group col-sm-4">
              <label for="supplier">N° de Factura</label>
                <h4>{{ $purchase->bill_number }}</h5>                  
            </div>
            <div class="form-group col-sm-1">
                <button
                  type="submit"
                  style="position: absolute; top: 20px;"
                  class="btn btn-info">
                  Guardar
                </button>                  
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection 