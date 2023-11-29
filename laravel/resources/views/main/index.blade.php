@extends('layouts.app')

@section('template_title')
    Title
@endsection

@section('content')
    <div class="container-fluid">
        <form class="form-inline">
            <div class="row">
                {{-- Options --}}
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-9">
                            <input name="txtBuscar" class="form-control" type="search" placeholder="Buscar Artista o Titulo"
                                aria-label="Search"
                                @isset($txtBuscar) value="{{ $txtBuscar }}" @endisset>
                        </div>
                        <div class="col-3 d-flex justify-content-center">
                            <button class="btn btn-sm btn-outline-dark" type="submit">Buscar</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 p-2 d-flex justify-content-end">
                    <strong>
                        <h6 class="text-md-end">

                            <a style="color: black; text-decoration:none"
                                href="{{ route('searchSoapLyrics') }}"><strong>SOAP Lyrics</strong></a>
                            | <a style="color: black; text-decoration:none"
                                href="{{ route('searchDeezerApi') }}"><strong>Deezer API</strong></a>
                            | <a style="color: black; text-decoration:none"
                                href="{{ route('searchSpotifyApi') }}"><strong>Spotyfi API</strong></a>
                        </h6>
                    </strong>
                </div>
                <div class="col-md-1 p-2">
                </div>
                <hr>
            </div>
            <br>
            <div class="row">
                {{-- Filters --}}
                <div class="col-md-2">
                    <strong>{{ Form::label('Sort') }}</strong>
                    <select class="form-select" name="txtSort">
                        <option value="1"
                            @isset($txtSort) {{ $txtSort == '1' ? 'selected="selected"' : '' }}@endisset>
                            Latests Releases</option>
                        <option value="2"
                            @isset($txtSort) {{ $txtSort == '2' ? 'selected="selected"' : '' }}@endisset>
                            Artist A-Z</option>
                        <option value="3"
                            @isset($txtSort) {{ $txtSort == '3' ? 'selected="selected"' : '' }}@endisset>
                            Artist Z-A</option>
                        <option value="4"
                            @isset($txtSort) {{ $txtSort == '4' ? 'selected="selected"' : '' }}@endisset>
                            Title A-Z</option>
                        <option value="5"
                            @isset($txtSort) {{ $txtSort == '5' ? 'selected="selected"' : '' }}@endisset>
                            Title Z-A</option>
                    </select>
                    <hr>
                    <br>
                    <strong>{{ Form::label('Style') }}</strong>
                    <select class="form-select" name="txtStyle">
                        <option value=""></option>
                        @foreach ($styles as $style)
                            @isset($txtStyle)
                                <option value={{ $style->id }} {{ $style->id == $txtStyle ? 'selected="selected"' : '' }}>
                                    {{ $style->estilo }}</option>
                            @else
                                <option value={{ $style->id }}>{{ $style->estilo }}</option>
                            @endisset
                        @endforeach
                    </select>
                    <br>
                    <strong>{{ Form::label('Format') }}</strong>
                    <select class="form-select" name="txtFormat">
                        <option value=""></option>
                        @foreach ($formats as $format)
                            @isset($txtFormat)
                                <option value={{ $format->id }}
                                    {{ $format->id == $txtFormat ? 'selected="selected"' : '' }}>{{ $format->formato }}
                                </option>
                            @else
                                <option value={{ $format->id }}>{{ $format->formato }}</option>
                            @endisset
                        @endforeach
                    </select>
                    <br>
                    <strong>{{ Form::label('Country') }}</strong>
                    <select class="form-select" name="txtCountry">
                        <option value=""></option>
                        @foreach ($countries as $country)
                            @isset($txtFormat)
                                <option value={{ $country->id }}
                                    {{ $country->id == $txtCountry ? 'selected="selected"' : '' }}>{{ $country->nombre }}
                                </option>
                            @else
                                <option value={{ $country->id }}>{{ $country->nombre }}</option>
                            @endisset
                        @endforeach
                    </select>
                    <br>
                    <strong>{{ Form::label('Year') }}</strong>
                    <select class="form-select" name="txtYear">
                        <option value=""></option>
                        @foreach ($decades as $decade)
                            <option value={{ $decade }} {{ $decade == $txtYear ? 'selected="selected"' : '' }}>
                                {{ $decade }}</option>
                        @endforeach
                    </select>
                    <br>
                    <button class="btn btn-outline-danger" type="reset">Reset</button>
                </div>

                {{-- content --}}
                <div class="col-md-10">
                    <div class="row">
                        @foreach ($titles as $title)
                            <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2 col-xxl-2">
                                <div class="card" onMouseOver="coloron(this)" onMouseOut="coloroff(this)">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="row">
                                                        @php $aux_imagen = 'media\\' . 'no_available.jpg' @endphp
                                                        @foreach ($title->images as $i)
                                                            @if ($i->filename == 'front.jpg')
                                                                @php $aux_imagen = 'media\\' . $title->id . '\\' . $i->filename @endphp
                                                            @endif
                                                        @endforeach

                                                        <a href="{{ route('main.show', $title->id) }}">
                                                            <img src="{{ asset($aux_imagen) }}"
                                                                alt="{{ $title->artista . ' ' . $title->titulo }}"
                                                                width="100%" height="100%">
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <strong>Artista:</strong>
                                                    {{ $title->artista }}
                                                </div>
                                                <div class="form-group">
                                                    <strong>Titulo:</strong>
                                                    {{ $title->titulo }}
                                                </div>
                                                <div class="form-group">
                                                    <strong>Formato:</strong>
                                                    {{ $title->format->formato }} {{ $title->country->nombre }}
                                                    {{ $title->catalogo }}
                                                </div>
                                                <br>
                                                <div class="form-group">
                                                    <strong>Sello:</strong>
                                                    {{ $title->sello }}
                                                </div>
                                                <div class="form-group">
                                                    <strong>Estilo:</strong>
                                                    {{ $title->style->estilo }}
                                                </div>
                                                <div class="form-group">
                                                    <strong>Released:</strong>
                                                    {{ $title->released }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row">
                        {!! $titles->appends(request()->input())->links() !!}
                    </div>
                </div>
            </div>
        </form>
        <div style="background-color:#7e7c82"></div>
        <div style="background-image: {{ asset('imagenes/docs-blur.jpg') }}">
            <br>
            <br>
            <br>
            <br>
            <br>

        </div>
    </div>
    <script src="{{ asset('js/recordar.js') }}"></script>
    
@endsection
