<div class="form-group">
    <label for="medico_id">Medico</label>
    <select id="medico_id" class="form-control js-example-basic-single" name="medico_id">
        <option selected disabled value="">Seleccione medico</option>
        @foreach ($medicos as $medico)
            <option value="{{ $medico->id }}">{{ $medico->nombre }} {{ $medico->apellido }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" class="form-control" id="exampleTextarea1" rows="4"></textarea>
</div>


<div class="form-group">
    <label for="fecha">Fecha</label>
    <div id="datepicker-popup" class="input-group date datepicker">
        <input type="text" name="fecha" class="form-control">
        <span class="input-group-addon input-group-append border-left">
            <span class="far fa-calendar input-group-text"></span>
        </span>
    </div>
</div>

<div class="form-group">
    <label for="Turno_id">Hora Inicio</label>
    <div class="input-group date" id="timepicker-example" data-target-input="nearest">
        <div class="input-group" data-target="#timepicker-example" data-toggle="datetimepicker">
            <input type="text" name="inicio" class="form-control datetimepicker-input" data-target="#timepicker-example" />
            <div class="input-group-addon input-group-append"><i class="far fa-clock input-group-text"></i></div>
        </div>
    </div>
</div>


<div class="form-group">
    <label for="Turno_id">Hora Fin</label>
    <div class="input-group date" id="timepicker-example1" data-target-input="nearest">
        <div class="input-group" data-target="#timepicker-example1" data-toggle="datetimepicker">
            <input type="text" name="fin" class="form-control datetimepicker-input" data-target="#timepicker-example1" />
            <div class="input-group-addon input-group-append"><i class="far fa-clock input-group-text"></i></div>
        </div>
    </div>
</div>

