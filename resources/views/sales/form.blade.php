<div class="card-body">
  <div class="row">
    <div class="col-12 col-lg-6">
      <br><br>
      <div class="form-group row">
        <div class="col-md-12">
          <div class="col-md-6">
            Cliente
          </div>

          <input type="hidden" name="sale" id="sale" value="0">
          <select name="customer_id" id="customer_id" class="chosen-select">
            <option value="">Seleccione un Cliente</option>
              @foreach($customers as $c)
                <option value="{{$c->id}}">{{ $c->name }}</option>
              @endforeach
          </select>
        </div>
      </div>

      <div class="form-group row">
        <div class="col-md-12">
          <div class="col-md-6">
            Fecha de la Venta
          </div>
          <input id="sale_date" type="text" class="fechita form-control @error('sale_date') is-invalid @enderror" name="sale_date" value="{{ empty($sale) ? date('d-m-Y') : $sale->sale_date }}" placeholder="Ingrese fecha" title="Nombre">
          @error('sale_date')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
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
                        <table width="100%" class="table-bordered" id="tablita">
                          <thead>
                            <tr>
                              <th>Cantidad</th>
                              <th>Producto ($)</th>
                              <th>Cantidad</th>
                              <th>Precio ($)</th>
                              <th>Acciones</th>
                            </tr>
                          </thead>
                          <tbody>
                            
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