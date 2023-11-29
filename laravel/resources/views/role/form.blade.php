<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $role->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('guard_name') }}
            {{ Form::text('guard_name', $role->guard_name, ['class' => 'form-control' . ($errors->has('guard_name') ? ' is-invalid' : ''), 'placeholder' => 'Guard Name', 'readonly'=>'true' ]) }}
            {!! $errors->first('guard_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <br>Permisos
        <fieldset name="permisos" id="permisos" multiple="multiple">
            @foreach ($permisos as $id => $permisos)
            <input type="checkbox" name="asignarPermisos[{{ $id }}]" value="{{ $id }}" {{ (isset($role) && $role->permissions()->pluck('name', 'id')->contains($id)) ? 'checked': '' }}>
            <label for="{{ $permisos }}"> {{ $permisos }} </label>
            <br>
            @endforeach
        </fieldset>
        
    </div>
    <div class="box-footer mt20">
    <a class="btn btn-primary" href="{{ route('roles.index') }}"> {{ __('Back') }}</a>
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>