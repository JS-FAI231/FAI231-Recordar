@extends('layouts.app')

@section('template_title')
    Show Track
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Track</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tracks.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Titulo:</strong>
                            {{ $track->title->artista }} {{ $track->title->titulo }}
                        </div>
                        <div class="form-group">
                            <strong>Track:</strong>
                            {{ $track->track }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $track->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Duracion:</strong>
                            {{ $track->duracion }}
                        </div>
                        <div class="form-group">
                            <strong>Path:</strong>
                            {{ $track->path }}
                        </div>
                        <div class="form-group">
                            <strong>Filename:</strong>
                            {{ $track->filename }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
