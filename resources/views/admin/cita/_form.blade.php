<form id="example-form" action="#"></form>



<form id="example-vertical-wizard">
    <div>
        <h3>Especialidad</h3>
        <section>
            <h4>Especialidad</h4>
            <div class="m-25">
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <select id="especialidad_id" class="form-control" name="especialidad_id">
                            <option selected disabled value="">Seleccione la especialidad</option>
                            @foreach ($especialidades as $especialidad)
                                <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </section>
        <h3>Fechas</h3>
        <section>
            <h4>Fechas</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="especialidad_id">Fecha de Cita</label>
                        <div id="datepicker-popup" class="input-group date datepicker">
                            <input type="text" class="form-control" id="fecha"
                                placeholder="buscar fecha disponible" name="fecha" autocomplete="off">
                            <span class="input-group-addon input-group-append border-left">
                                <span class="far fa-calendar input-group-text"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <h3>Medicos</h3>
        <section class="mi-section">
            <h4>Medicos</h4>
            <div class="row justify-content-center align-items-center g-2" id="medicosContainer">
            </div>
        </section>
        <h3>Finalizar</h3>
        <section>
            <h4>Finalizar</h4>
            <div class="m-25">
                <p>Seleccionar horario de la cita</p>
            </div>
            <div class="row justify-content-center align-items-center g-2" >
                <select id="hora" name="hora" class="form-control">
                </select>
            </div>

        </section>
    </div>
</form>
