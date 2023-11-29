@extends('layouts.app')

@section('template_title')
    {{ $visit->name ?? "{{ __('Show') Visit" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Visit</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('visits.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Updated Ar:</strong>
                            {{ $visit->updated_ar }}
                        </div>
                        <div class="form-group">
                            <strong>Title Id:</strong>
                            {{ $visit->title_id }}
                        </div>
                        <div class="form-group">
                            <strong>Comentario:</strong>
                            {{ $visit->comentario }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
