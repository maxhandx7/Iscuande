<form id="example-form" action="#"></form>



<form id="example-vertical-wizard" >
    <div >
        <h3>Especialidad</h3>
        <section>
            <h4>Especialidad</h4>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="especialidad_id">Especialidades</label>
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
                                placeholder="buscar fecha disponible" name="fecha">
                            <span class="input-group-addon input-group-append border-left">
                                <span class="far fa-calendar input-group-text"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <h3>Finalizar</h3>
        <section>
            <h4>Finalizar</h4>

                    <div id="info-ok" hidden>
                        <div class="alert alert-success">
                            Citas disponibles
                        </div>
                        <div class="table-responsive">
                        <table id="tabla-turnos" class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Fecha</th>
                                    <th>Descripción</th>
                                    <th>Médico</th>
                                    <th>Horas</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                        </div>
                    </div>
                    <div class="alert alert-danger" id="info-error" hidden>
                        No se encontraron citas para el dia seleccionado, por favor vulva a intentar
                    </div>
            
        </section>
    </div>
</form>
