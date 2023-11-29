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
                            <span class="card-title">{{ __('Show') }} Image</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('images.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Title Id:</strong>
                            ( {{ $image->title_id }} ) {{ $image->title->artista }} {{ $image->title->titulo }} 
                        </div>
                        <div class="form-group">
                            <strong>Path:</strong>
                            {{ $image->path }}
                        </div>
                        <div class="form-group">
                            <strong>Filename:</strong>
                            {{ $image->filename }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
