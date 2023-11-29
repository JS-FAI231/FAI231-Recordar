@extends('layouts.app')

@section('template_title')
    SPOTIFY DATA
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                
                <div class="card">
                    <div class="card-header">
                        <form class="form-inline" action="{{ route('searchSpotifyApi') }}" method="GET">
                            <div class="row" style="align-items: center">
                                <div class="col-2">
                                    <span id="card_title">
                                        <img src="{{ asset('imagenes\spotify.png') }}" alt="spotify.com" height="40px">
                                    </span>
                                </div>
                                <div class="col-3">
                                    <input name="txtBuscar" class="form-control" type="search"
                                        placeholder="Buscar con API Spotify" aria-label="Search"
                                        @isset($txtBuscar) value="{{ $txtBuscar }}" @endisset>
                                </div>
                                {{-- <div class="col-1">
                                    <select class="form-control" name="txtType" placeholder="Type Search">
                                        <option value="multi">Multile Fields</option>
                                        <option value="albums">Albums</option>
                                        <option value="artist">Artist</option>
                                        <option value="tracks">Tracks</option>
                                    </select>
                                </div> --}}
                                <div class="col-3 ">
                                    <button class="btn btn-sm btn-outline-success" type="submit">Buscar</button>
                                </div>
                                <div class="col-3">
                                </div>
                            </div>
                        </form>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            @isset($spotifymultiresponse)
                                @php
                                    $albums = $spotifymultiresponse->albums->items;
                                    $tracks = $spotifymultiresponse->tracks->items;
                                @endphp
                            @endisset

                            @isset($albums)
                                <h3><strong>Lista de Albumes</strong></h3>
                                <hr>
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>Cover</th>
                                            <th>Artist</th>
                                            <th>Album</th>
                                            <th>Release</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($albums as $data)
                                            <tr>
                                                <td><a href="#">
                                                        <img src="{{ $data->data->coverArt->sources[0]->url }}" alt="nada"
                                                            height="60px">
                                                    </a>
                                                </td>
                                                <td>{{ $data->data->artists->items[0]->profile->name }}</td>
                                                <td>{{ $data->data->name }}</td>
                                                <td>{{ $data->data->date->year }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            @endisset


                            @isset($tracks)
                                <br><br>
                                <h3><strong>Lista de Tracks</strong></h3>
                                <hr>
                                <table class="table table-striped table-hover">
                                    <thead class="thead">
                                        <tr>
                                            <th>Cover</th>
                                            <th>Track</th>
                                            <th>Album</th>
                                            <th>Artist</th>
                                            <th>Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($tracks as $data)
                                            <tr>
                                                <td><a href="#">
                                                        <img src="{{ $data->data->albumOfTrack->coverArt->sources[0]->url }}"
                                                            alt="nada" height="60px">
                                                    </a>
                                                </td>
                                                <td>{{ $data->data->name }} </td>
                                                <td>{{ $data->data->albumOfTrack->name }} </td>
                                                <td>{{ $data->data->artists->items[0]->profile->name }} </td>
                                                @php
                                                    $horas = floor(($data->data->duration->totalMilliseconds/1000) / 3600);
                                                    $minutos = floor((($data->data->duration->totalMilliseconds/1000) - $horas * 3600) / 60);
                                                    $segundos = floor(($data->data->duration->totalMilliseconds/1000) - $horas * 3600 - $minutos * 60);
                                                    $duration = $minutos . ':' . $segundos . ' min';
                                                @endphp
                                                <td>{{ $duration }} </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                @endisset
                        </div>
                    </div>
                </div>
                {{-- {!! $titles->links() !!} --}}
            </div>
        </div>
    </div>
@endsection
