<form class="form-inline">
<div class="row">
    <div class="col-10">
        <input name="txtBuscar" class="form-control" type="search" placeholder="Buscar Artista o Titulo" aria-label="Search"
            @isset($txtBuscar) value="{{ $txtBuscar }}" @endisset>
    </div>

    <div class="col-2">
        <button class="btn btn-sm btn-outline-success" type="submit">Buscar</button>
    </div>
</div>
</form>
