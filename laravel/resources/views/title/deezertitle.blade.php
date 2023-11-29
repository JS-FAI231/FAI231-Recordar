@extends('layouts.app')

@section('template_title')
    {{-- $title->name ?? "__('Show') Title"  --}}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                @isset($deezerresponse)
                    <div class="card">
                        <div class="card-header">
                            <div class="row" style="align-items: center">
                                <div class="col-md-2">
                                    <img src="{{ asset('imagenes\deezer.png') }}" alt="deezer.com" width="100%">
                                </div>
                                <div class="col-md-10">
                                    <h1><span class="card-title"><strong>{{ $deezerresponse->artist->name }} -
                                        {{ $deezerresponse->title }}</strong></span></h1>
                                </div>
                            </div>
                            
                            
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="row">
                                            <img src="{{ $deezerresponse->cover_medium }}" alt="{{ $deezerresponse->title }}"
                                                width="100%" height="100%">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <strong>Artist:</strong>
                                        {{ $deezerresponse->artist->name }}

                                    </div>
                                    <div class="form-group">
                                        <strong>Title:</strong>
                                        {{ $deezerresponse->title }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Format:</strong>
                                        {{ $deezerresponse->type }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Catalog:</strong>
                                        {{ $deezerresponse->upc }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Label:</strong>
                                        {{ $deezerresponse->label }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Style:</strong>
                                        {{ $deezerresponse->genres->data[0]->name }}
                                    </div>
                                    <div class="form-group">
                                        <strong>Released:</strong>
                                        {{ $deezerresponse->release_date }}
                                    </div>

                                </div>

                                <div class="col-md-6">

                                </div>
                            </div>


                            <hr>

                            <div class="col-md-12">
                                <strong>Tracklist</strong>
                                <br>
                                @php $data=$deezerresponse->tracks->data @endphp


                                <div class="table-responsive">
                                    <table class="table table-striped table-hover">
                                        <thead class="thead">
                                            <tr>
                                                @if($deezerresponse->artist->name=='Vários intérpretes')
                                                <th>Artist</th>
                                                @endif
                                                <th>Title</th>
                                                <th>Duration</th>
                                                <th>Preview</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $track)
                                                <tr>
                                                    @if($deezerresponse->artist->name=='Vários intérpretes')
                                                    <td>{{ $track->artist->name }}</td>
                                                    @endif
                                                    <td>{{ $track->title }}</td>
                                                    @php
                                                        $horas = floor($track->duration / 3600);
                                                        $minutos = floor(($track->duration - $horas * 3600) / 60);
                                                        $segundos = $track->duration - $horas * 3600 - $minutos * 60;
                                                        $duration = $minutos . ':' . $segundos . ' min';
                                                    @endphp
                                                    <td>{{ $duration }}</td>
                                                    <td><audio controls preload="none">
                                                            <source src="{{ $track->preview }}" type="audio/mpeg">
                                                        </audio></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endisset
            </div>
        </div>
    </section>
@endsection
