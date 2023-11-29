@extends('layouts.app')

@section('template_title')
    DEEZER DATA
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <form class="form-inline" action="{{ route('searchDeezerApi') }}" method="GET">
                            <div class="row" style="align-items: center">
                                <div class="col-2">
                                    <span id="card_title">
                                        <img src="{{ asset('imagenes\deezer.png') }}" alt="spotify.com" width="100%">
                                    </span>
                                </div>
                                <div class="col-4">
                                    <input name="txtBuscar" class="form-control" type="search"
                                        placeholder="Buscar con API Deezer" aria-label="Search"
                                        @isset($txtBuscar) value="{{ $txtBuscar }}" @endisset>
                                </div>
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
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>Cover</th>
                                        <th>Title</th>

                                        <th>Artist</th>
                                        <th>Album</th>
                                        <th>Duration</th>
                                        <th>Preview</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($deezerresponse)
                                        @foreach ($deezerresponse as $data)
                                            <tr>
                                                <td><a href="{{ route('titleDeezerApi', $data->album->id) }}">
                                                        <img src="{{ $data->album->cover_small }}"
                                                            alt="{{ $data->album->title }}" height="60px">
                                                    </a>
                                                </td>
                                                <td>{{ $data->title }}</td>

                                                <td>{{ $data->artist->name }}</td>
                                                <td>{{ $data->album->title }}</td>
                                                @php
                                                    $horas = floor($data->duration / 3600);
                                                    $minutos = floor(($data->duration - $horas * 3600) / 60);
                                                    $segundos = $data->duration - $horas * 3600 - $minutos * 60;
                                                    $duration = $minutos . ':' . $segundos . ' min';
                                                @endphp
                                                <td>{{ $duration }}</td>

                                                <td><audio controls preload="none">
                                                        <source src="{{ $data->preview }}" type="audio/mpeg">
                                                    </audio></td>


                                                <td>
                                                    {{-- <form action="{{ route('titles.destroy',$title->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('titles.show',$title->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('titles.edit',$title->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form> --}}
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- {!! $titles->links() !!} --}}
            </div>
        </div>
    </div>
@endsection
