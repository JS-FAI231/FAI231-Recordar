@extends('layouts.app')

@section('template_title')
    Activity Log
@endsection

@section('content')
    <div class="container-fluid">
        {{-- Titulos mas visitados --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <strong>Titulos mas vistos</strong>
                            </span>

                            <div class="float-right">

                            </div>
                        </div>
                    </div>


                    <div class="card-body">
                        <div class="row">
                            @foreach ($mostVisitedTitles as $item)
                                @php $title=$item['title'] @endphp

                                @isset($title)
                                    <div class="col-sm-4 col-md-3 col-lg-2">
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
                                                            <span style="color:firebrick"><strong>{{ $title->artista }}
                                                                </strong></span>
                                                            <strong>{{ $title->titulo }}</strong>
                                                        </div>
                                                        <div class="form-group">

                                                            {{ $item['times'] }} @if ($item['times'] > '1')
                                                                veces
                                                            @else
                                                                vez
                                                            @endif
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endisset
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <br>
        <hr>
        <br>
        {{-- Titulos mas calificados --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <strong>Titulos mas calificados</strong>
                            </span>
                            @php
                                $nTitulos = count($wishes);
                                $nCarpetas = count($folders);
                            @endphp
                            <div class="float-right">

                                <strong>{{ $nTitulos }} Titulos en Favoritos, {{ $nCarpetas }} Carpetas</strong>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @foreach ($ratedTitles as $item)
                                @php $wish=$item['wish'] @endphp

                                @isset($wish)
                                    @php $title=$wish->title @endphp
                                    <div class="col-sm-4 col-md-3 col-lg-2">
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
                                                            <span style="color:firebrick"><strong>{{ $title->artista }}
                                                                </strong></span>
                                                            <strong>{{ $title->titulo }}</strong>
                                                        </div>
                                                        <div class="form-group">

                                                            {{ $item['times'] }} @if ($item['times'] > '1')
                                                                veces
                                                            @else
                                                                vez
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            Calificacion Actual :
                                                            @for ($i = 1; $i < 6; $i++)
                                                                @if ($title->valoracion >= $i)
                                                                    <i id="redstar{{ $i }}" class="fa-solid fa-star"
                                                                        style="color: green;"></i>
                                                                @else
                                                                    <i id="redstar{{ $i }}"
                                                                        class="fa-regular fa-star"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                @endisset
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <hr>
        <br>
        {{-- Mas Informacion --}}
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                <strong>Mas Informacion</strong>
                            </span>

                            <div class="float-right">

                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 p-1">
                                <div class="card" style="background-color:#eff7ff">
                                    <div class="card-body">
                                        <strong>Solicitudes:</strong> {{ count($demands) }}
                                        <ul>
                                            @foreach ($demands as $demand)
                                                <li>
                                                    {{ $demand->nombre }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 p-1">
                                <div class="card" style="background-color:#eff7ff">
                                    <div class="card-body">
                                        @php $cantTitulosSugeridos=0 @endphp
                                        @foreach ($submissions as $submission)
                                            @isset($submission->title_id)
                                                @php $cantTitulosSugeridos= $cantTitulosSugeridos+1 @endphp
                                            @endisset
                                        @endforeach
                                        <strong>Respuestas:</strong> {{ count($submissions) }} con
                                        {{ $cantTitulosSugeridos }}
                                        <strong>Titulos sugeridos</strong> <br>

                                        @foreach ($submissions as $submission)
                                            @isset($submission->title_id)
                                                <i class="fa-solid fa-paperclip" style="color:rgb(32, 108, 152);"></i>
                                                {{ $submission->title->titulo }}
                                                <br>
                                            @endisset
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 p-1">
                                <div class="card" style="background-color:#eff7ff">
                                    <div class="card-body">
                                        <strong>Tu Calificación Promedio:</strong>
                                        @for ($i = 1; $i < 6; $i++)
                                            @if (Auth::user()->rating >= $i)
                                                <i id="redstar{{ $i }}" class="fa-solid fa-star"
                                                    style="color:rgb(32, 108, 152);"></i>
                                            @else
                                                <i id="redstar{{ $i }}" class="fa-regular fa-star"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>

               


        {{-- DataTable --}}
        <br>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Activity Log') }}
                            </span>

                            <div class="float-right">
                                {{-- <a href="{{ route('activitylogs.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a> --}}
                            </div>
                        </div>
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
                                        {{-- <th>No</th> --}}

                                        <th>Log Name</th>
                                        <th>Description</th>
                                        <th>Subject Type</th>
                                        <th>Event</th>
                                        <th>Subject Id</th>
                                        <th>Causer Type</th>
                                        <th>Causer Id</th>
                                        <th>Properties</th>
                                        <th>Batch Uuid</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activityLogs as $activityLog)
                                        <tr>
                                            {{-- <td>{{ ++$i }}</td> --}}

                                            <td>{{ $activityLog->log_name }}</td>
                                            <td>{{ $activityLog->description }} times</td>
                                            <td>{{ $activityLog->subject_type }}</td>
                                            <td>{{ $activityLog->event }}</td>
                                            <td>{{ $activityLog->subject_id }}</td>
                                            <td>{{ $activityLog->causer_type }}</td>
                                            <td>{{ $activityLog->causer_id }}</td>
                                            <td>{{ $activityLog->properties }}</td>
                                            <td>{{ $activityLog->batch_uuid }}</td>

                                            <td>
                                                <form action="{{ route('activitylogs.destroy', $activityLog->id) }}"
                                                    method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary " href="{{ route('activitylogs.show',$activityLog->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a> --}}
                                                    {{-- <a class="btn btn-sm btn-success" href="{{ route('activitylogs.edit',$activityLog->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a> --}}
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $activityLogs->links() !!}
            </div>
        </div>
    </div>
@endsection
