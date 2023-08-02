<div class="form-group">
    <label for="user_id">Medico *</label>
    <select id="user_id" class="form-control js-example-basic-single @error('user_id') is-invalid @enderror"
        name="user_id">
        <option selected disabled value="">Seleccione medico</option>
        @foreach ($medicos as $medico)
            <option value="{{ $medico->id }}">{{ $medico->name }} {{ $medico->apellido }} -
                {{ $medico->especialidad->nombre }}</option>
        @endforeach
    </select>
    @error('user_id')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group">
    <label for="descripcion">Descripción *</label>
    <textarea name="descripcion" class="form-control @error('descripcion') is-invalid @enderror" id="exampleTextarea1"
        rows="4"></textarea>
    @error('descripcion')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>


<div class="form-group">
    <label for="fecha">Fecha *</label>
    <div id="datepicker-popup" class="input-group date datepicker">
        <input type="text" name="fecha" class="form-control @error('fecha') is-invalid @enderror"
            autocomplete="off">
        <span class="input-group-addon  border-left">
            <span class="far fa-calendar input-group-text"></span>
        </span>
        @error('fecha')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>

<div class="form-group">
    <label for="Turno_id">Hora Inicio *</label>
    <div class="input-group date" id="timepicker-example" data-target-input="nearest">
        <div class="input-group" data-target="#timepicker-example" data-toggle="datetimepicker">
            <input type="text" name="inicio" class="form-control datetimepicker-input"
                data-target="#timepicker-example" required autocomplete="off" autofocus />
            <div class="input-group-addon input-group-append"><i class="far fa-clock input-group-text"></i></div>
        </div>
    </div>
</div>


<div class="form-group">
    <label for="Turno_id">Hora Fin *</label>
    <div class="input-group date" id="timepicker-example1" data-target-input="nearest">
        <div class="input-group" data-target="#timepicker-example1" data-toggle="datetimepicker">
            <input type="text" name="fin" class="form-control datetimepicker-input"
                data-target="#timepicker-example1" required autocomplete="off" autofocus />
            <div class="input-group-addon input-group-append"><i class="far fa-clock input-group-text"></i></div>
        </div>
    </div>
</div>

<div class="form-group">
    <label for="iCitas">Intervalo entre citas (en minutos)*</label>
    <input id="iCitas" type="text" class="form-control @error('iCitas') is-invalid @enderror" name="iCitas"
        value="30" required autocomplete="iCitas" autofocus>
</div>
