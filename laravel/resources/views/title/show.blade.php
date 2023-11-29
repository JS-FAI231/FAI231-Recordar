@extends('layouts.app')

@section('template_title')
     {{-- $title->name ?? "__('Show') Title"  --}}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Title</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('titles.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="row">
                                        <?php
                                        $aux_imagen="media\\"."no_available.jpg";
                                        foreach ($title->images as $i){
                                            if ($i->filename=='front.jpg'){
                                                $aux_imagen="media\\".$title->id."\\".$i->filename;
                                            }
                                        }
                                        ?>
                                        <img src="{{ asset($aux_imagen) }}" alt="{{ $title->artista .' '. $title->titulo}}" width="100%" height="100%">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <strong>Artista:</strong>
                                    {{ $title->artista }}
        
                                </div>
                                <div class="form-group">
                                    <strong>Titulo:</strong>
                                    {{ $title->titulo }}
                                </div>
                                <div class="form-group">
                                    <strong>Format Id:</strong>
                                    {{ $title->format->formato }} {{ $title->format->descripcion }}
                                </div>
                                <div class="form-group">
                                    <strong>Country Id:</strong>
                                    {{ $title->country->nombre }}
                                </div>
                                <div class="form-group">
                                    <strong>Catalogo:</strong>
                                    {{ $title->catalogo }}
                                </div>
                                <div class="form-group">
                                    <strong>Sello:</strong>
                                    {{ $title->sello }}
                                </div>
                                <div class="form-group">
                                    <strong>Style Id:</strong>
                                    {{ $title->style->estilo }}
                                </div>
                                <div class="form-group">
                                    <strong>Released:</strong>
                                    {{ $title->released }}
                                </div>
                                
                            </div>
                            
                            <div class="col-md-6">
                                <strong>Tracks</strong>
                                <br>
                                @foreach($title->tracks as $track)    
                                    {{ $track->filename}}
                                    <br>
                                @endforeach
                            </div>
                            
                        </div>
                        <hr>
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="form-group">
                                    <strong>Creditos:</strong>
                                    {{ $title->creditos }}
                                </div>
                                <div class="form-group">
                                    <strong>Notas:</strong>
                                    {{ $title->notas }}
                                </div>
                                <div class="form-group">
                                    <strong>Review:</strong>
                                    {{ $title->review }}
                                </div>
                                <div class="form-group">
                                    <strong>Version Id:</strong>
                                    {{ $title->version_id }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
