<div  class="form-group">
    <label for="Fecha">Seleccione fecha de cita</label>
    <select id="Fecha" class="form-control js-example-basic-single" name="FechaCita">
        <option selected disabled value="">Fechas disponibles</option>
        @foreach ($cupos as $cupo)
        <option value="{{$cupo->id}}">{{$cupo->fecha}}</option>
        @endforeach
    </select>
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

<input type="hidden" value="1" id="cupos" name="cupos">








