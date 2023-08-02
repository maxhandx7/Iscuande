<div class="form-group">
    <label for="name">Nombre (*)</label>
    <input type="text" name="name" id="name" class="form-control @error('email') is-invalid @enderror" placeholder="Nombre de la publicacion">
    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="Previa">Previa</label>
    <textarea class="form-control" name="Previa" id="Previa" rows="3"></textarea>
    @error('Previa')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    <label for="body">Descripción</label>
    <textarea class="form-control" name="body" id="summernoteExample" rows="10"></textarea>
    @error('body')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>
