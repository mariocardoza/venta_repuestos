<div class="card-body">
  <div class="row">
    <div class="col-12">
      <br><br>
      <div class="form-group row">
        <div class="col-md-6">
          <label for="">Proveedor</label>
          <input id="supplier" type="text" class="form-control @error('supplier') is-invalid @enderror" name="supplier" value="{{ empty($purchase) ? old('supplier') : $purchase->supplier }}" placeholder="Nombre" title="Proveedor" autocomplete="off">
          @error('supplier')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
        <div class="col-md-6">
          <label for="">N° de factura</label>
          <input type="text" class="form-control  @error('bill_number') is-invalid @enderror" name="bill_number" id="bill_number" value="{{ empty($purchase) ? old('bill_number') : $purchase->bill_number }}" autocomplete="off">
           @error('bill_number')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-6">
          <label for="">Fecha de la compra</label>
          <input type="text" name="date" class="form-control fechita  @error('date') is-invalid @enderror" value="{{ empty($purchase) ? old('supplier') : $purchase->date->format('d-m-Y') }}" autocomplete="off">
          <input id="total" type="hidden" step="any" value="0.00" class="form-control @error('total') is-invalid @enderror" name="total" value="{{ empty($purchase) ? old('total') : $purchase->total }}" placeholder="$0.00" title="Total">
          @error('date')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
        <div class="col-md-6">
          <label for="">Total de la compra</label>
          <input id="total" readonly type="number" step="any" class="form-control @error('total') is-invalid @enderror" name="total" value="{{ empty($purchase) ? 0.0 : $purchase->total }}" placeholder="$0.00" title="Total">
          @error('date')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
    </div>
  </div>
</div>




