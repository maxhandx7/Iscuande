<div class="form-group">
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" id="nombre" class="form-control ">
</div>


<div class="form-group">
    <label for="apellido">Apellido</label>
    <input type="text" name="apellido" id="apellido" class="form-control ">
</div>


<div class="form-group">
    <label for="cedula">Cedula</label>
    <input type="text" name="cedula" id="cedula" class="form-control ">
</div>

<div class="form-group">
    <label for="especialidad_id">Especialidad</label>
    <select id="especialidad_id" class="form-control js-example-basic-single" name="especialidad_id">
        <option selected disabled value="">Seleccione la especialidad</option>
        @foreach ($especialidades as $especialidad)
            <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
        @endforeach
    </select>
</div>





