@extends('layouts.app')

@section('template_title')
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" 
                        @if($demand->user_id==Auth::user()->id)
                            style="background-color: #7e7c82; color:white"

                        @endif>
                        <div class="row">
                            <div class="col-9 text-center">
                                <h2>{{ $demand->nombre }}</h2>
                            </div>
                            <div class="col-3 text-center">
                                <strong>Request by: </strong> {{ $demand->user->name }}
                                {{-- <br>
                                <strong>status: </strong> {{ $demand->status }} --}}
                            </div>
                            

                        </div>
                    </div>
                    <div class="card-body" @if($demand->user_id==Auth::user()->id)
                        style="background-color: #7e7c82"

                    @endif>
                        <div class="row" id="mensajes">
                            <div class="row" style="display: none">
                                <div class="row" id="respuestas">
                                    {{-- Respuestas --}}
                                    <div class="row m-1 p-2 rounded text-end" style="background-color:rgb(215, 222, 225)">
                                        <div class="col-md-9">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    {{-- <a class="btn btn-sm btn-danger" href=""><i
                                                            class="fa fa-fw fa-trash"></i>Delete</a> --}}
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <p id="comentario"></p>
                                            </div>
                                        </div>

                                        <div class="col-md-3 rounded bg-light">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <i class="fa-solid fa-paperclip" style="color:grey;"></i>
                                                    <p>Title sugested</p>
                                                </div>
                                                <div class="col-md-6">
                                                    <a href="">
                                                        <img src=""
                                                            alt=""
                                                            width="100%">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- <div class="col-md-3 rounded bg-light">
                                            <i class="fa-solid fa-paperclip" style="color:grey;"></i> Title sugested
                                        </div> --}}

                                    </div>
                                </div>
                            </div>

                            @foreach ($demand->submissions as $submission)
                                @if ($submission->user_id != Auth::user()->id)
                                    <div class="row" id="preguntas">
                                        {{-- Preguntas --}}
                                        <div class="row m-1 p-2 rounded" style="background-color:rgb(240, 240, 240)">
                                            <div class="col-md-9 ">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        {{-- <a class="btn btn-sm btn-danger" href=""><i class="fa fa-fw fa-trash"></i>Delete</a> --}}

                                                        From: <strong>{{ $submission->user->name }}</strong>
                                                        {!! '&nbsp;' !!}{!! '&nbsp;' !!}{!! '&nbsp;' !!}
                                                        @for ($i = 1; $i < 6; $i++)
                                                            @if ($submission->rating >= $i)
                                                                <i id="redstar{{ $submission->id }}{{ $i }}"
                                                                    class="fa-solid fa-star"
                                                                    onclick="javascript:rateUserSubmission({{ $submission->id }},{{ $i }},'{{ route('rateUserSubmission') }}')"
                                                                    style="color:dodgerblue;"></i>
                                                            @else
                                                                <i id="redstar{{ $submission->id }}{{ $i }}"
                                                                    class="fa-regular fa-star"
                                                                    onclick="javascript:rateUserSubmission({{ $submission->id }},{{ $i }},'{{ route('rateUserSubmission') }}')"></i>
                                                            @endif
                                                        @endfor
                                                        {!! '&nbsp;' !!}{!! '&nbsp;' !!}
                                                        <i id="redstar0" class="fa-sharp fa-solid fa-xmark"
                                                            onclick="javascript:rateUserSubmission({{ $submission->id }},'0','{{ route('rateUserSubmission') }}')"></i>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row" id="submission"{{ $submission->id }}>
                                                    <p id="comentario">{{ $submission->comentario }}</p>
                                                </div>
                                            </div>
                                            {{-- @if ($demand->user_id != $submission->user_id) --}}
                                            <div class="col-md-3 rounded bg-light">
                                                <div class="row">
                                                    <div class="col-md-6">

                                                        <i class="fa-solid fa-paperclip" style="color:grey;"></i>
                                                        @if ($submission->title_id != null)
                                                            {{ $submission->title->titulo }}
                                                        @else
                                                            Title sugested
                                                        @endif

                                                    </div>
                                                    <div class="col-md-6">
                                                        @if ($submission->title_id != null)
                                                            @php $aux_imagen = 'media\\' . 'no_available.jpg' @endphp
                                                            @foreach ($submission->title->images as $i)
                                                                @if ($i->filename == 'front.jpg')
                                                                    @php $aux_imagen = 'media\\' . $submission->title->id . '\\' . $i->filename @endphp
                                                                @endif
                                                            @endforeach

                                                            <a href="{{ route('main.show', $submission->title_id) }}">
                                                                <img src="{{ asset($aux_imagen) }}"
                                                                    alt="{{ $submission->title->artista . ' ' . $submission->title->titulo }}"
                                                                    width="100%">
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- @endif --}}
                                        </div>
                                    </div>
                                @else
                                    <div class="row" id="respuestas">
                                        {{-- Respuestas --}}
                                        <div class="row m-1 p-1 rounded text-end"
                                            style="background-color:rgb(215, 222, 225)">
                                            <div class="col-md-9">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        {{-- <a class="btn btn-sm btn-danger" href=""><i
                                                                class="fa fa-fw fa-trash"></i>Delete</a> --}}
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <p id="comentario">{{ $submission->comentario }}</p>
                                                </div>
                                            </div>
                                            {{-- @if ($demand->user_id != $submission->user_id) --}}
                                            <div class="col-md-3 rounded bg-light">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <i class="fa-solid fa-paperclip" style="color:grey;"></i>
                                                        @if ($submission->title_id != null)
                                                            {{ $submission->title->titulo }}
                                                        @else
                                                            Title sugested
                                                        @endif
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if ($submission->title_id != null)
                                                            @php $aux_imagen = 'media\\' . 'no_available.jpg' @endphp
                                                            @foreach ($submission->title->images as $i)
                                                                @if ($i->filename == 'front.jpg')
                                                                    @php $aux_imagen = 'media\\' . $submission->title->id . '\\' . $i->filename @endphp
                                                                @endif
                                                            @endforeach

                                                            <a href="{{ route('main.show', $submission->title_id) }}">
                                                                <img src="{{ asset($aux_imagen) }}"
                                                                    alt="{{ $submission->title->artista . ' ' . $submission->title->titulo }}"
                                                                    width="100%">
                                                            </a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- @endif --}}
                                        </div>
                                    </div>
                                @endif
                            @endforeach


                        </div>
                        <br>
                        {{-- sendmessagesbox --}}
                        <div class="row m-1">
                            <div class="col-6">
                                <input class="form-control" type="text"
                                    placeholder="{{ Auth::user()->name }}, write a message..."
                                    aria-label=".form-control-sm example" id="txtMensaje">
                            </div>
                            <div class="col-3">
                                <select class="form-select" id="title_id" name="title_id" value="{{ old('title_id') }}">
                                    <option value="">Titulo Sugerido</option>
                                    @isset($titles)
                                        @foreach ($titles as $title)
                                            <option value="{{ $title->id }}">
                                                {{ $title->artista }} {{ $title->titulo }}
                                                ({{ $title->format->formato }} {{ $title->format->descripcion }}
                                                {{ $title->catalogo }})
                                            </option>
                                        @endforeach
                                    @else
                                    @endisset
                                </select>
                            </div>
                            <div class="col-3">
                                <a class="btn" style="background-color:rgb(237, 237, 237)"
                                    onclick="addMessageResponse({{ $demand->id }},{{ Auth::user()->id }},'{{ route('addMessageResponse') }}')"><i
                                        class="fa-regular fa-share-from-square"></i>Send</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('js/recordar.js') }}"></script>
    </section>
@endsection
