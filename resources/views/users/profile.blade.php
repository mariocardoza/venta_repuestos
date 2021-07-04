@extends('layouts.app')
@section('cabecera')
    <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Perfil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home')}}">Inicio</a></li>
              <li class="breadcrumb-item active">Perfil</li>
            </ol>
          </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection
@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"></h3>
                    </div>
                    <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="card-body">
                        	<div class="form-group row">
	                          <div class="col-md-12">
	                            <label>Adjunte foto de perfil</label>
	                            <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="" placeholder="Seleccionar avatar" title="Seleccione avatar">
	                            <p class="info-text">Formatos permitidos: png. Dimensión 100x100px. Máx: 2mb.</p>
	                            @error('avatar')
							        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
							     @enderror
	                            <div class="logo-form text-center"><img src="{{ auth()->user()->avatar=='' ? asset('images/no-disponible.jpg') : auth()->user()->avatar }}" height="100" alt=""></div>
	                          </div>
                        	</div>
                        	<div class="form-group row">
	                        	<div class="col-md-6">
	                        		<label for="">Nombre</label>
	                        		<input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{auth()->user()->name}}">
	                        		@error('name')
							        	<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
							      	@enderror
		                        </div>
	                        	<div class="col-md-6">
	                        		<label for="username">Nombre de usuario</label>
	                        		<input id="username" type="text" name="username" class="form-control @error('username') is-invalid @enderror" value="{{auth()->user()->username}}">
	                        		@error('username')
							        	<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
							      	@enderror
	                        	</div>	
	                        </div>
	                        <div class="form-group row">
	                        	<div class="col-md-6">
	                        		<label for="">DUI</label>
	                        		<input type="text" name="dui" class="form-control dui" value="{{auth()->user()->dui}}">
		                        </div>
	                        	<div class="col-md-6">
	                        		<label for="">NIT</label>
	                        		<input type="text" name="nit" class="form-control nit" value="{{auth()->user()->nit}}"></div>
	                        </div>
	                        <div class="form-group row">
	                        	<div class="col-md-6">
	                        		<label for="">Teléfono</label>
	                        		<input type="text" name="phone" class="form-control phone" value="{{auth()->user()->phone}}">
		                        </div>
	                        	<div class="col-md-6">
	                        		<label for="">Correo electrónico</label>
	                        		<input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{auth()->user()->email}}">
	                        		@error('email')
							        	<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
							      	@enderror
	                        	</div>
	                        </div>
	                        <div class="form-group row">
	                        	<div class="col-md-6">
	                        		<label for="">Contraseña</label>
	                        		<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ empty($user) ? old('password') : '' }}" placeholder="Contraseña" title="Contraseña">
							      	@error('password')
							        	<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
							      	@enderror
		                        </div>
	                        	<div class="col-md-6">
	                        		<label for="">Confirmar contraseña</label>
	                        		<input id="confirm-password" type="password" class="form-control @error('confirm-password') is-invalid @enderror" name="password_confirmation" value="{{ empty($user) ? old('confirm-password') : '' }}" placeholder="Contraseña" title="Contraseña">
								    @error('confirm-password')
								        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								    @enderror
	                        	</div>
	                        </div>
                        </div>
                        <br>
                        <div class="text-center">
                          <button type="submit" class="btn btn-info btn-accept">Guardar</button>
                          <a href="{{route('dashboard')}}" class="btn btn-default btn-clear">Regresar</a>
                        </div>
                        <br>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection