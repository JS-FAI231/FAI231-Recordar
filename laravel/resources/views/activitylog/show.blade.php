@extends('layouts.app')

@section('template_title')
    {{-- {{ $activityLog->name ?? "{{ __('Show') Activity Log" }} --}}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Activity Log</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('activitylogs.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Log Name:</strong>
                            {{ $activityLog->log_name }}
                        </div>
                        <div class="form-group">
                            <strong>Description:</strong>
                            {{ $activityLog->description }}
                        </div>
                        <div class="form-group">
                            <strong>Subject Type:</strong>
                            {{ $activityLog->subject_type }}
                        </div>
                        <div class="form-group">
                            <strong>Event:</strong>
                            {{ $activityLog->event }}
                        </div>
                        <div class="form-group">
                            <strong>Subject Id:</strong>
                            {{ $activityLog->subject_id }}
                        </div>
                        <div class="form-group">
                            <strong>Causer Type:</strong>
                            {{ $activityLog->causer_type }}
                        </div>
                        <div class="form-group">
                            <strong>Causer Id:</strong>
                            {{ $activityLog->causer_id }}
                        </div>
                        <div class="form-group">
                            <strong>Properties:</strong>
                            {{ $activityLog->properties }}
                        </div>
                        <div class="form-group">
                            <strong>Batch Uuid:</strong>
                            {{ $activityLog->batch_uuid }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
