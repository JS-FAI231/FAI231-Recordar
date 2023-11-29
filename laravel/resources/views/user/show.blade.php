@extends('layouts.app')

@section('template_title')
{{ $user->name ?? "{{ __('Show') User" }}
@endsection

@section('content')
<section class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="float-left">
                        <span class="card-title">{{ __('Show') }} User</span>
                    </div>
                    <div class="float-right">
                        <a class="btn btn-primary" href="{{ route('users.index') }}"> {{ __('Back') }}</a>
                    </div>
                </div>

                <div class="card-body">

                    <div class="form-group">
                        <strong>Name:</strong>
                        {{ $user->name }}
                    </div>
                    <div class="form-group">
                        <strong>Email:</strong>
                        {{ $user->email }}
                    </div>
                    
                    <br>Roles
                    <fieldset name="roles" id="roles" multiple="multiple">
                        @foreach ($roles as $id => $roles)
                        <input type="checkbox" disabled readonly name="asignarRoles[{{ $id }}]" value="{{ $id }}" {{ (isset($user) && $user->roles()->pluck('name', 'id')->contains($id)) ? 'checked': '' }}>
                        <label for="{{ $roles }}"> {{ $roles }} </label>
                        <br>
                        @endforeach
                    </fieldset>

                    <br>Permisos
                    <fieldset name="permisos" id="permisos" multiple="multiple">
                        @foreach ($permisos as $id => $permisos)
                        <input type="checkbox" disabled readonly name="asignarPermisos[{{ $id }}]" value="{{ $id }}" {{ (isset($user) && $user->permissions()->pluck('name', 'id')->contains($id)) ? 'checked': '' }}>
                        <label for="{{ $permisos }}"> {{ $permisos }} </label>
                        <br>
                        @endforeach
                    </fieldset>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection