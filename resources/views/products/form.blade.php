<div class="card-body">
  <div class="row">
    <div class="col-12 col-lg-6">
      <br><br>
      <div class="form-group row">
        <div class="col-md-12">
          <label for="">Nombre del producto</label>
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ empty($product) ? old('name') : $product->name }}" placeholder="Nombre" title="Nombre">
          @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-12">
          <label for="">Código del Producto</label>
          <input id="code" type="text" class="form-control @error('code') is-invalid @enderror" name="code" value="{{ empty($product) ? old('code') : $product->code }}" placeholder="Código" title="Nombre">
          @error('code')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-12">
          <label for="">Precio ($)</label>
          <input id="price" step="any" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ empty($product) ? old('price') : $product->price }}" placeholder="$0.00" title="Precio">
          @error('price')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-12">
          <label for="">Marca del automóvil</label>
          <select class="form-control" name="category_id" id="category_id">
            <option value="">Ninguna</option>
            @foreach($categories as $category)
              @if(isset($product) && $category->id==$product->category_id)
                <option selected value="{{$category->id}}">{{$category->name}}</option>
              @else
                <option value="{{$category->id}}">{{$category->name}}</option>
              @endif
            @endforeach
          </select>
          @error('category_id')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-12">
          <label for="">Modelo del automóvil</label>
          <select class="form-control" name="subcategory_id" id="subcategory_id">
            <option value="">Ninguna</option>
          </select>
          @error('subcategory_id')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <div class="col-md-12">
          <label for="">Número de motor</label>
          <input id="engine_number" type="text" class="form-control @error('engine_number') is-invalid @enderror" name="engine_number" value="{{ empty($product) ? old('engine_number') : $product->engine_number }}" placeholder="N°" title="Precio">
          @error('engine_number')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
    </div>
    <div class="col-12 col-lg-6">
      <div class="form-group row">
        <p class="text-center">Imagen del producto</p>
        <img src="{{ empty($product->image) ? asset('images/default-image.jpg') : $product->url_image }}" id="input-image" class="img-fluid">
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




