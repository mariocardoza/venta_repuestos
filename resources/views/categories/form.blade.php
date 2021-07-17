<div class="card-body">
  <div class="row">
    <div class="col-12">
      <br><br>
      <div class="form-group row">
        <div class="col-12">
          <label>Nombre</label>
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ empty($category) ? old('name') : $category->name }}" placeholder="Marcas" title="Marca">
          @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
    </div>
  </div>
</div>




