<div class="card-body">
  <div class="form-group row">
    <div class="col-md-12 text-center">
      <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ empty($user) ? old('name') : $user->name }}" placeholder="Nombre completo" title="Nombre completo">
      @error('name')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
      @enderror
    </div>
  </div>

  <div class="form-group row">
    <div class="col-md-12 text-center">
      <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ empty($user) ? old('email') : $user->email }}" placeholder="Correo electrónico" title="Correo electrónico">
      @error('email')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
      @enderror
    </div>
  </div>

  <div class="form-group row">
    <div class="col-md-12 text-center">
      <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ empty($user) ? old('username') : $user->username }}" placeholder="Correo electrónico" title="Correo electrónico">
      @error('username')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
      @enderror
    </div>
  </div>

  <div class="form-group row">
    <div class="col-md-12 text-center">
      <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ empty($user) ? old('phone') : $user->phone }}" placeholder="Teléfono" title="Teléfono">
      @error('phone')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
      @enderror
    </div>
  </div>

  <div class="form-group row">
    <div class="col-md-12 text-center">
      <select name="role_id" class="form-control @error('role_id') is-invalid @enderror" id="role_id">
        <option value="">Seleccione un rol</option>
        @foreach($roles as $rol)
          @if(isset($user) && $rol->id==$user->role_id)
            <option selected value="{{$rol->id}}">{{$rol->name}}</option>
          @else
            <option value="{{$rol->id}}">{{$rol->name}}</option>
          @endif
        @endforeach
      </select>
      @error('role_id')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
      @enderror
    </div>
  </div>
  <div class="form-group row">
    <div class="col-md-12 text-center">
      <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ empty($user) ? old('password') : '' }}" placeholder="Contraseña" title="Contraseña">
      @error('password')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
      @enderror
    </div>
  </div>

  <div class="form-group row">
    <div class="col-md-12 text-center">
      <input id="confirm-password" type="password" class="form-control @error('confirm-password') is-invalid @enderror" name="password_confirmation" value="{{ empty($user) ? old('confirm-password') : '' }}" placeholder="Confirmar contraseña" title="Contraseña">
      @error('confirm-password')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
      @enderror
    </div>
  </div>
</div>
