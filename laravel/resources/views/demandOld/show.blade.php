@extends('layouts.app')

@section('template_title')
    {{-- {{ $demand->name ?? "{{ __('Show') Demand" }} --}}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Demand</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('demands.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $demand->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $demand->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Status:</strong>
                            {{ $demand->status }}
                        </div>
                        <div class="form-group">
                            <strong>Style Id:</strong>
                            {{ $demand->style_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
