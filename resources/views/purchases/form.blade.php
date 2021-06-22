<div class="card-body">
  <div class="row">
    <div class="col-12 col-lg-6">
      <br><br>
      <div class="form-group row">
        <div class="col-md-12">
          <div class="col-md-4">
            Proveedor
          </div>
          <input id="supplier" type="text" class="form-control @error('supplier') is-invalid @enderror" name="supplier" value="{{ empty($purchase) ? old('supplier') : $purchase->supplier }}" placeholder="Nombre" title="Proveedor">
          @error('supplier')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-12">
          <div class="col-md-6">
            Total de la Compra ($)
          </div>
          <input id="total" type="number" step="any" class="form-control @error('total') is-invalid @enderror" name="total" value="{{ empty($purchase) ? old('total') : $purchase->total }}" placeholder="$0.00" title="Total">
          @error('total')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
    </div>
  </div>
</div>




