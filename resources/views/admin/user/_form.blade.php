<div class="form-group">
    <label for="name">Nombre</label>
    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
        value="{{ old('name') }}" required autocomplete="name" autofocus>
</div>


<div class="form-group">
    <label for="apellido">Apellido</label>
    <input id="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror" name="apellido"
        value="{{ old('apellido') }}" required autocomplete="apellido" autofocus>
</div>

<div class="form-group">
    <label for="tipo">Tipo de usuario</label>
    <select id="tipo" class="form-control js-example-basic-single @error('tipo') is-invalid @enderror" name="tipo"
        name="tipo" required autocomplete="tipo" autofocus>
        <option selected disabled value="">Seleccione tipo de usuario</option>
        <option value="ADMIN">Administrador</option>
        <option value="MEDICO">Medico</option>   
        <option value="PACIENTE">Paciente</option>   
    </select>
</div>


<div class="form-group especialidad_id" hidden>
    <label>Especialidad</label>
    <select id="especialidad_id" class="form-control " name="especialidad_id">
    </select>
</div>

<div class="form-group">
    <label for="tipo_documento">Tipo de codumento</label>
    <select id="tipo_documento" class="form-control js-example-basic-single @error('tipo_documento') is-invalid @enderror" name="tipo_documento"
        name="tipo_documento" required autocomplete="tipo_documento" autofocus>
        <option selected disabled value="">Seleccione tipo de documento</option>
        <option value="cc">Cedula</option>
        <option value="ce">Cedula de extranjeria</option>
        <option value="nit">Nit</option>
        <option value="ti">Tarjeta de identidad</option>
    </select>
</div>

<div class="form-group">
    <label for="no_documento">N° documento</label>
    <input id="no_documento" type="number" class="form-control @error('no_documento') is-invalid @enderror"
        name="no_documento" value="{{ old('no_documento') }}" required autocomplete="no_documento" autofocus>

</div>

<div class="form-group">
    <label for="telefono">Telefono</label>
    <input id="telefono" type="text" class="form-control @error('telefono') is-invalid @enderror" name="telefono"
        value="{{ old('telefono') }}" autocomplete="telefono" autofocus>
</div>

<div class="form-group">
    <label for="email">Email</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
        value="{{ old('email') }}" required autocomplete="email">
</div>
<div class="form-group">
    <label for="password">Contraseña</label>
    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
        required autocomplete="new-password">
</div>







