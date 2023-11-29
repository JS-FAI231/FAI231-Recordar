@extends('layouts.app')

@section('template_title')
    SOAP Lyrics api.chartlyrics.com/apiv1.asmx?WSDL
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <form class="form-inline" action="{{ route('searchSoapLyrics') }}" method="GET">
                            <div class="row" style="align-items: center">
                                <div class="col-2">
                                    <span id="card_title">
                                        {{ __('SOAP Lyrics') }}
                                    </span>
                                </div>
                                <div class="col-2">
                                    <input name="txtArtist" class="form-control" type="search" placeholder="Artist"
                                        aria-label="SearchArtist"
                                        @isset($txtArtist) value="{{ $txtArtist }}" @endisset>
                                </div>
                                <div class="col-2">
                                    <input name="txtSong" class="form-control" type="search" placeholder="Song"
                                        aria-label="SearchSong"
                                        @isset($txtSong) value="{{ $txtSong }}" @endisset>
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
                                        <th>LyricId</th>
                                        <th>Artist</th>
                                        <th>Song</th>
                                        <th>Ranking</th>
                                        <th>Lyrics</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($response)
                                        @foreach ($response as $data)
                                            <tr>
                                                @isset($data)
                                                    @if ($data->LyricId != '0')
                                                        <td>
                                                            {{ $data->LyricId }}
                                                        </td>
                                                        <td>
                                                            {{ $data->Artist }}
                                                        </td>
                                                        <td>
                                                            <a style="color: black; text-decoration:none"
                                                                href="{{ route('textSoapLyrics', ['id' => $data->LyricId, 'chks' => $data->LyricChecksum]) }}">
                                                                <strong>{{ $data->Song }}</strong>
                                                            </a>
                                                        </td>
                                                        <td>
                                                            {{ $data->SongRank }}
                                                        </td>
                                                        <td>
                                                            <a style="color: black; text-decoration:none"
                                                                href="{{ $data->SongUrl }}"><strong>Ver Letras</strong></a>
                                                        </td>
                                                    @endif
                                                @endisset
                                        @endforeach
                                        </tr>
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
