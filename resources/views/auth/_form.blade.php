<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
            value="{{ old('name') }}" required autocomplete="name" autofocus>

        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


<div class="form-group row">
    <label for="apellido" class="col-md-4 col-form-label text-md-right">{{ __('Apellido') }}</label>

    <div class="col-md-6">
        <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror"
            name="apellido" value="{{ old('apellido') }}" required autocomplete="apellido" autofocus>

        @error('apellido')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="tipo_documento" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de documento') }}</label>
    <div class="col-md-6">
        <select id="tipo_documento" class="form-control @error('tipo_documento') is-invalid @enderror"
            name="tipo_documento" name="tipo_documento" required autocomplete="tipo_documento" autofocus>
            <option selected disabled value="">Seleccione tipo de documento</option>
            <option value="cc">Cedula</option>
            <option value="ce">Cedula de extranjeria</option>
            <option value="nit">Nit</option>
            <option value="ti">Tarjeta de identidad</option>
        </select>
        @error('tipo_documento')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>


<div class="form-group row">
    <label for="no_documento" class="col-md-4 col-form-label text-md-right">{{ __('N° documento') }}</label>

    <div class="col-md-6">
        <input id="no_documento" type="number" class="form-control @error('no_documento') is-invalid @enderror"
            name="no_documento" value="{{ old('no_documento') }}" required autocomplete="no_documento" autofocus>

        @error('no_documento')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>



<div class="form-group row">
    <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('telefono') }}</label>

    <div class="col-md-6">
        <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono"
            value="{{ old('telefono') }}"  autocomplete="telefono" autofocus>

        @error('telefono')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Correo electronico') }}</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
            value="{{ old('email') }}" required autocomplete="email">

        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

    <div class="col-md-6">
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
            name="password" required autocomplete="new-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmar contraseña') }}</label>

    <div class="col-md-6">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required
            autocomplete="new-password">
    </div>
</div>


