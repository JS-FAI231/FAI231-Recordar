<div class="box box-info padding-1">

<div class="box-body">

        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Name', 'readonly' => 'true']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email', 'readonly' => 'true']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        <br>Roles
        <fieldset name="roles" id="roles" multiple="multiple">
            @foreach ($roles as $id => $roles)
            <input type="checkbox" name="asignarRoles[{{ $id }}]" value="{{ $id }}" {{ (isset($user) && $user->roles()->pluck('name', 'id')->contains($id)) ? 'checked': '' }}>
            <label for="{{ $roles }}"> {{ $roles }} </label>
            <br>
            @endforeach
        </fieldset>
        <br>Permisos
        <fieldset name="permisos" id="permisos" multiple="multiple">
            @foreach ($permisos as $id => $permisos)
            <input type="checkbox" name="asignarPermisos[{{ $id }}]" value="{{ $id }}" {{ (isset($user) && $user->permissions()->pluck('name', 'id')->contains($id)) ? 'checked': '' }}>
            <label for="{{ $permisos }}"> {{ $permisos }} </label>
            <br>
            @endforeach
        </fieldset>

        <br>

    </div>
    <div class="box-footer mt20">
        <a class="btn btn-primary" href="{{ route('users.index') }}"> {{ __('Back') }}</a>
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>