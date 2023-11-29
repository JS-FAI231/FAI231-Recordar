@extends('layouts.app')

@section('template_title')
    {{-- {{ $country->name ?? {{ Country }} }} --}}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Country</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('countries.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $country->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Habilitado:</strong>
                            {{ $country->deshabilitado }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
