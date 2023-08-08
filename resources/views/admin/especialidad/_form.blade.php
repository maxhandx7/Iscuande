<div class="form-group">
    <label for="nombre">Nombre *</label>
    <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror">
    @error('nombre')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror
</div>


<div class="form-group">
    <label for="descripcion">Descripción</label>
    <textarea name="descripcion" class="form-control" id="descripcion" rows="4"></textarea>
</div>


