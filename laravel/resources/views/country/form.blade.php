<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    {{ Form::label('nombre') }}
                    {{ Form::text('nombre', $country->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
                    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <br>
            <div class="col-md-1">
                <div class="form-group">
                    {{ Form::label('Habilitado') }}
                    {{-- {{ Form::text('deshabilitado', $country->deshabilitado, ['class' => 'form-control' . ($errors->has('deshabilitado') ? ' is-invalid' : ''), 'placeholder' => 'Deshabilitado']) }} --}}
                    <input type="checkbox" name="deshabilitado" id="deshabilitado" value="{{ $country->deshabilitado }}"
                        {{ ($country->deshabilitado != null ? 'checked' : '') }}
                    >
                    {!! $errors->first('deshabilitado', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>