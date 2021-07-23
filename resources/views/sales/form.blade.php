<div class="card-body">
  <div class="row">
    <div class="col-12">
      <div class="form-group row">
        <div class="col-12 col-md-6 ">
          <label for="">Cliente</label>
          <input type="hidden" name="sale_id" id="sale_id" value="0">
          <select name="customer_id" id="customer_id" class="form-control">
            <option value="">Seleccione un Cliente</option>
              @foreach($customers as $c)
                <option value="{{$c->id}}">{{ $c->name }}</option>
              @endforeach
              @if($c == "")
                $c = "0";
              @endif
          </select>
        </div>
        <div class="col-md-3 col-6">
          <label for="">Comprobante</label>
          <select name="receipt_type" id="receipt_type" class="form-control">
            @foreach($receipts as $receipt)
              <option value="{{$receipt->id}}">{{$receipt->name}}</option>
            @endforeach
          </select>
          @error('receipt_type')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
        <div class="col-md-3 col-6">
          <label for="">Fecha de venta</label>
          <input id="sale_date" type="text" class="fechita form-control @error('sale_date') is-invalid @enderror" name="sale_date" value="{{ empty($sale) ? date('d-m-Y') : $sale->sale_date }}" placeholder="Ingrese fecha" title="Nombre">
          @error('sale_date')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>

      <div class="form-group row">
        
      </div>

      <div class="row">
              <div class="col-md-12">
                <div class="card card-default">
                  <div class="card-header">
                    <h3 class="float-left">Detalle de la Venta</h3>
                    <div class="float-right">
                      <button type="button" id="md_trabajos" class="btn btn-info"><i class="fas fa-plus"></i>Producto</button>
                    </div>
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
                                <th class="table-secondary">Precio $</th>
                                <th class="table-secondary">Cantidad</th>
                                <th class="table-secondary">Subtotal</th>
                                <th class="table-secondary">Acciones</th>
                              </tr>
                            </thead>
                            <tbody></tbody>
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