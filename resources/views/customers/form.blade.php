<div class="card-body">
  <div class="row">
    <div class="col-12">
      <br><br>
      <div class="form-group row">
        <div class="col-sm-12 col-md-6">
          <div class="col-sm-2">
            <label>Nombre</label>
          </div>
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ empty($customer) ? old('name') : $customer->name }}" placeholder="Clientes" title="Cliente">
          @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        <div class="col-sm-12 col-md-6">
          <div class="col-sm-4">
            <label>N° de DUI</label>
          </div>
          <input id="dui" type="text" class="form-control dui @error('dui') is-invalid @enderror" name="dui" value="{{ empty($customer) ? old('dui') : $customer->dui }}" placeholder="99999999-9" title="DUI">
          @error('dui')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>

      <div class="form-group row">
        <div class="col-sm-12 col-md-6">
          <div class="col-sm-4">
            <label>N° de NIT</label>
          </div>
          <input id="nit" type="text" class="form-control nit @error('nit') is-invalid @enderror" name="nit" value="{{ empty($customer) ? old('nit') : $customer->nit }}" placeholder="9999-999999-999-9" title="NIT">
          @error('nit')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
        <div class="col-sm-12 col-md-6">
          <div class="col-sm-4">
            <label>N° de NRC</label>
          </div>
          <input id="nrc" type="number" class="form-control @error('nrc') is-invalid @enderror" name="nrc" value="{{ empty($customer) ? old('nrc') : $customer->nrc }}" placeholder="NRC" title="NRC">
          @error('nrc')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
      <div class="form-group row">

        <div class="col-sm-12 col-md-6">
          <div class="col-sm-6">
            <label>Correo Electrónico</label>
          </div>
          <input id="email" type="text" step="any" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ empty($customer) ? old('email') : $customer->email }}" placeholder="email@ejemplo.com" title="Correo">
          @error('email')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>

        <div class="col-sm-12 col-md-6">
          <div class="col-sm-4">
            <label>Teléfono</label>
          </div>
          <input id="phone" type="text" class="form-control phone @error('phone') is-invalid @enderror" name="phone" value="{{ empty($customer) ? old('phone') : $customer->phone }}" placeholder="9999-9999" title="Telefono">
          @error('phone')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-12">
          <div class="col-sm-4">
            <label>Dirección</label>
          </div>
          <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ empty($customer) ? old('address') : $customer->address }}" placeholder="Dirección" title="Direccion">
          @error('address')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
          @enderror
        </div>
      </div>
    </div>
  </div>
</div>




