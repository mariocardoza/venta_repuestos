<div class="card-body">
  <div class="row">
    <div class="col-12">
      <br><br>
      <div class="form-group row">
        <div class="col-12">
          <label>Nombre</label>
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ empty($subcategory) ? old('name') : $subcategory->name }}" placeholder="Ej: Corolla" title="Submarca">
          @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
        <div class="col-12">
          <label for="">Marca</label>
          <select name="category_id" id="category_id" class="form-control @error('name') is-invalid @enderror">
            <option value="">Seleccione una Marca</option>
              @foreach($categories as $c)
                @if(isset($subcategory) && $c->id == $subcategory->category_id)
                  <option selected value="{{$c->id}}">{{ $c->name }}</option>
                @else
                  <option value="{{$c->id}}">{{ $c->name }}</option>
                @endif
              @endforeach
          </select>
          @error('category_id')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
    </div>
  </div>
</div>