@extends('layouts.app')

@section('template_title')

@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Submission</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('submissions.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                                                
                        <div class="form-group">
                            <strong>Demand Id:</strong>
                            ({{ $submission->demand_id }}) {{ $submission->demand->nombre }} <br><strong>Status: </strong> {{ $submission->demand->status }}
                        </div>
                        <div class="form-group">
                            <strong>Title Id:</strong>
                            @isset($submission->title){{ $submission->title->artista }} - {{ $submission->title->titulo }}@endisset
                        </div>
                        <div class="form-group">
                            <strong>Respondido por:</strong>
                            {{ $submission->user->name }}
                        </div>
                        <div class="form-group">
                            <strong>Comentario:</strong>
                            {{ $submission->comentario }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
