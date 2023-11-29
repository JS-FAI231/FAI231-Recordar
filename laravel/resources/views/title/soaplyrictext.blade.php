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
                            <span class="card-title">SOAP Lyrics Text Song</span>
                        </div>
                        <div class="float-right">
                            {{-- <a class="btn btn-primary" href="{{ route('titles.index') }}"> {{ __('Back') }}</a> --}}
                        </div>
                    </div>

                    <div class="card-body">
                        @isset($responseText)
                            <div class="row">
                                <div class="col-md-3">
                                    <hr>
                                    <img src="{{ $responseText->LyricCovertArtUrl }}"
                                    alt="{{ $responseText->LyricArtist }}" width="100%">
                                    <hr>
                                </div>
                                <div class="col-md-3">
                                    <hr>
                                    <div class="form-group">
                                        <div class="row">
                                            <strong>Artist: {{ $responseText->LyricArtist }}</strong>
                                        </div>
                                        <div class="row">
                                            <strong>Song: {{ $responseText->LyricSong }}</strong>
                                        </div>
                                        <div class="row">
                                            <strong>Ranking: {{ $responseText->LyricRank }}</strong>
                                        </div>
                                    </div>
                                    <hr>
                                </div>
                                <div class="col-md-6">
                                    <hr>
                                    @php $arrText= explode("\n",$responseText->Lyric) @endphp
                                    @foreach ($arrText as $data)
                                        {{ $data }}<br>
                                    @endforeach
                                    <hr>
                                </div>
                            </div>
                        @endisset
                        <hr>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
