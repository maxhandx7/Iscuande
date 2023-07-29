<form id="example-form" action="#">

</form>

<form id="example-vertical-wizard" action="#">
    <div>
        <h3>Especialidad</h3>
        <section>
            <h4>Especialidad</h4>
            <div class="form-group p-5">
                <label for="especialidad_id">Especialidades</label>
                <select id="especialidad_id" class="form-control" name="especialidad_id">
                    <option selected disabled value="">Seleccione la especialidad</option>
                    @foreach ($especialidades as $especialidad)
                        <option value="{{ $especialidad->id }}">{{ $especialidad->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </section>
        <h3>Fechas</h3>
        <section>
            <h4>Fechas</h4>
            <div class="form-group p-5">
                <label for="especialidad_id">Fecha de Cita</label>
                <div id="datepicker-popup" class="input-group date datepicker">
                    <input type="text" class="form-control" id="fecha" placeholder="buscar fecha disponible"
                        name="fecha">
                </div>
            </div>
        </section>
        <h3>Finalizar</h3>
        <section>
            <h4>Finalizar</h4>
            <div id="info-ok" hidden>
                <div class="alert alert-success">
                    Cita encontrada
                </div>

                <p class="clearfix"> 
                    <span class="float-left" id="especialidad">
                    </span>
                </p>

                <p class="clearfix">
                    <span class="float-left">
                        medico
                    </span>
                    <span class="float-right text-muted" id="medico">
                      </span>
                </p>

                <p class="clearfix">
                    <span class="float-left">
                     Fecha
                    </span>
                    <span class="float-right text-muted" id="fecha">
                      </span>
                </p>

                <p class="clearfix">
                    <span class="float-left">
                     Descripcion
                    </span>
                    <span class="float-right text-muted" id="descripcion">
                      </span>
                </p>
            </div>
            <div class="alert alert-danger" id="info-error" hidden>
                 No se encontraron citas para el dia seleccionado, por favor vulva a intentar
            </div>

        </section>
    </div>
</form>







{{-- 


<div class="form-group">
    <label for="fecha">Fecha</label>
    <div id="datepicker-popup" class="input-group date datepicker">
        <input type="text" name="fecha" class="form-control">
        <span class="input-group-addon input-group-append border-left">
            <span class="far fa-calendar input-group-text"></span>
        </span>
    </div>
</div>


<input type="hidden" value="" id="FechaCita" name="FechaCita">


<div class="form-group">
    <label for="HoraCita">Seleccione hora de cita</label>
    <select id="HoraCita" class="form-control js-example-basic-single" name="HoraCita">
        <option selected disabled value="">Horas disponibles</option>
    </select>
</div>


<div class="form-group">
    <label for="cupo_id">Medico</label>
    <select id="cupo_id" class="form-control js-example-basic-single" name="cupo_id">
        <option selected disabled value="">Seleccione medico</option>
    </select>
</div>

<input type="hidden" value="1" id="turnos" name="turnos"> --}}
