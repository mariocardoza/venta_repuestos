<div class="card-body">
  <div class="row">
    <div class="col-12">
      <br><br>
      <div class="form-group row">
        <div class="col-md-6">
          <label for="">Producto</label>
          <input type="hidden" name="purchase_id" value="{{$purchase->id}}">
          <select name="product_id" id="product_id" class="form-control  @error('product_id') is-invalid @enderror">
            <option value="">Seleccione</option>
            @foreach($products as $product)
              @if(isset($purchase_detail) && $purchase_detail->product_id==$product->id)
                <option selected value="{{$product->id}}">{{$product->name}}</option>
              @else
                <option value="{{$product->id}}">{{$product->name}}</option>
              @endif
            @endforeach
          </select>
          @error('product_id')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
        <div class="col-md-6">
          <label for="">Cantidad</label>
          <input type="text" class="form-control  @error('quantity') is-invalid @enderror" name="quantity" id="quantity" value="{{ empty($purchase_detail) ? old('quantity') : $purchase_detail->quantity }}">
           @error('quantity')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-6">
          <label for="">Precio</label>
          <input id="price" type="number" step="any" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ empty($purchase_detail) ? old('price') : $purchase_detail->price }}" placeholder="$0.00" title="Total">
          @error('price')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
    </div>
  </div>
</div>




