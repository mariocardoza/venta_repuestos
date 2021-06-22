<div class="card-body">
  <div class="row">
    <div class="col-12 col-lg-6">
      <br><br>
      <div class="form-group row">
        <div class="col-md-12">
          <div class="col-md-6">
            Producto
          </div>
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ empty($product) ? old('name') : $product->name }}" placeholder="Nombre" title="Nombre">
          @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-12">
          <div class="col-md-6">
            Código del Producto
          </div>
          <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ empty($product) ? old('code') : $product->code }}" placeholder="Código" title="Nombre">
          @error('code')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-12">
          <div class="col-md-6">
            Precio ($)
          </div>
          <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ empty($product) ? old('price') : $product->price }}" placeholder="$0.00" title="Precio">
          @error('price')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-6">
      <div class="form-group row">
        <p class="text-center">Imagen del producto</p>
        <img src="{{ empty($product) ? asset('images/default-image.jpg') : $product->url_image }}" id="input-image" class="img-fluid">
        <p class="text-center mb-1">Seleccionar Imagen</p>
        <input type="file" name="image" accept="image/*" id="input-file" class="form-field">
        <p class="text-xs text-center">700x450px, peso máx 2mb y formato jpg.</p>
        @error('image')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
      </div>
    </div>
  </div>
</div>




