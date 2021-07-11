@extends('layouts.app') 
@section('content')
<div style="width: 100%;">
  <div class="row">
    <div class="col-lg-12">
      <div class="card card-secondary">
        <div class="card-header with-border">
          <h3 class="card-title">Datos de Venta</h3>
        </div>
          <div class="card-body">
            <a target="_blank" href="{{url('/admin/sales/pdf/'.$sale->id)}}" class="btn btn-info"><i class="fas fa-print"></i></a>
            <div class="form-group col-sm-7">
              <label for="supplier">Cliente</label>
                <h4>{{ $sale->customer->name }}</h4> 
            </div>
            <div class="form-group col-sm-7">
              <label for="supplier">Fecha de Venta</label>
                <h4>{{ $sale->sale_date }}</h4> 
            </div>
            <div class="form-group col-sm-7">
              <label for="supplier">Tipo de Comprobante</label>
                <h4> {{ $sale->receipt->name }}</h4> 
            </div>
            <div class="form-group col-sm-7">
              <label for="supplier">Total</label>
                <h4> $ {{ number_format($sale->total, 2) }}</h4> 
            </div>

            @if($sale->receipt_id == 3)
              <div class="form-group col-sm-7">
                <label for="supplier">IVA</label>
                <h4> $ {{ number_format($sale->iva, 2) }}</h4> 
            </div>
            @endif
            
          </div>

          <div class="row">
              <div class="col-md-12">
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="float-left">Detalle de la Venta</h3>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="table-responsive">
                          <table width="100%" class="table table-bordered" id="tabita">
                            <thead>
                              <tr>
                                <th class="table-secondary">Código</th>
                                <th class="table-secondary">Producto</th>
                                <th class="table-secondary">Precio</th>
                                <th class="table-secondary">Cantidad</th>
                                <th class="table-secondary">Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($sale->detail as $detail)
                              <tr>
                                <td>{{ $detail->product->code }}</td>
                                <td>{{ $detail->product->name }}</td>
                                <td> $ {{ number_format($detail->price, 2) }}</td>
                                <td>{{ $detail->amount }}</td>
                                <td> $ {{ number_format($detail->amount * $detail->price, 2) }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                            <tfoot></tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

      </div>
    </div>
  </div>
</div>
@endsection 