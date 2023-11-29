@extends('layouts.app')

@section('template_title')
    {{-- $title->name ?? "__('Show') Title"  --}}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    {{-- <div class="col-6 d-flex justify-content-start">
                        <a class="btn btn-sm btn-primary" href="{{ route('main.index') }}"><i
                                class="fa-regular fa-circle-left"></i> Back </a>
                    </div> --}}
                    <div class="col-6 d-flex justify-content-start">
                        <a class="btn btn-sm btn-primary" href="javascript:history.back()"><i
                                class="fa-regular fa-circle-left"></i> Back </a>
                    </div>
                    <div class="col-6 d-flex justify-content-end">

                        <a class="btn btn-sm btn-success" href="{{ route('titles.edit', $title->id) }}"><i
                                class="fa fa-fw fa-edit"></i> Edit Title</a>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                {{-- <span class="card-title"> --}}
                                <h3> {{ $title->artista }} - {{ $title->titulo }}</h3>

                                {{-- </span> --}}
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <div class="row">
                                                <?php
                                                $aux_imagen = 'media\\' . 'no_available.jpg';
                                                foreach ($title->images as $i) {
                                                    if ($i->filename == 'front.jpg') {
                                                        $aux_imagen = 'media\\' . $title->id . '\\' . $i->filename;
                                                    }
                                                }
                                                ?>
                                                <img src="{{ asset($aux_imagen) }}"
                                                    alt="{{ $title->artista . ' ' . $title->titulo }}" width="100%"
                                                    height="100%">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-7">
                                        <div class="card">
                                            {{-- <div class="card-header">
                                                <strong> {{ $title->artista }} - {{ $title->titulo }}</strong>
                                            </div> --}}
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <strong>Artista:</strong>
                                                    {{ $title->artista }}
                                                </div>
                                                <div class="form-group">
                                                    <strong>Titulo:</strong>
                                                    {{ $title->titulo }}
                                                </div>
                                                <div class="form-group">
                                                    <strong>Format:</strong>
                                                    {{ $title->format->formato }} {{ $title->format->descripcion }}
                                                </div>
                                                <div class="form-group">
                                                    <strong>Country:</strong>
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
                                                    <strong>Style:</strong>
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
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <span class="card-title"> Tracklist </span>
                                            </div>
                                            <div class="card-body">

                                                <table class="table table-striped table-hover">
                                                    <thead class="thead">
                                                        <tr>
                                                            <th>Track Name</th>
                                                            <th>Play</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($title->tracks as $track)
                                                            <tr>
                                                                <td>{{ $track->filename }}</td>
                                                                <td>
                                                                    <audio controls preload="none">
                                                                        <source
                                                                            src="{{ asset($track->path . $track->filename) }}"
                                                                            type="audio/mpeg">
                                                                    </audio>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <strong>Creditos:</strong>
                                                    {{ $title->creditos }}
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <strong>Notas:</strong>
                                                    {{ $title->notas }}

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
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


                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card border-warning">
                                            <div class="card-header text-dark bg-warning">
                                                <div class="float-left">
                                                    <span class="card-title"><strong> Wishlist Options</strong> </span>
                                                </div>
                                                <div class="float-right">
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @if (Auth::user() == null)
                                                        <a class="btn btn-sm btn-warning" href="{{ route('login') }}">Login
                                                            for add to Wishlist</a>
                                                    @else
                                                        @php $auxExiste=false @endphp
                                                        @foreach ($title->wishes as $wish)
                                                            @if ($wish->user_id == Auth::user()->id)
                                                                @php $auxExiste=true @endphp
                                                            @endif
                                                        @endforeach
                                                        @if (!$auxExiste)
                                                            <form id="wishForm" class="form-inline"
                                                                action="{{ route('addtowish') }}" method="POST"
                                                                role="form" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="title_id"
                                                                    value={{ $title->id }}>
                                                                <input type="hidden" name="user_id"
                                                                    value={{ Auth::user()->id }}>
                                                                <button class="btn btn-sm btn-warning" type="submit"><i
                                                                        class="fa-regular fa-heart"
                                                                        style="color:rgb(0, 0, 0)"></i> Add To
                                                                    Wishlist</button>
                                                            </form>
                                                        @else
                                                            <form id="wishForm" class="form-inline"
                                                                action="{{ route('removefromwish') }}" method="POST"
                                                                role="form" enctype="multipart/form-data">
                                                                @csrf
                                                                <input type="hidden" name="title_id"
                                                                    value={{ $title->id }}>
                                                                <input type="hidden" name="user_id"
                                                                    value={{ Auth::user()->id }}>
                                                                <button class="btn btn-sm btn-danger " type="submit"><i
                                                                        class="fa-solid fa-heart" style="color:white"></i>
                                                                    Remove from Wishlist</button>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="alert alert-warning">
                                                        Folder
                                                        <select id="id1" class="form-control"
                                                            style="color:rgb(20, 14, 84)" name="txtFolder"
                                                            onchange="javascript:setFolder({{ $wish->title_id }},'{{ route('setFolder') }}')"> 
                                                            <option value="">Ninguno</option>
                                                            @foreach ($folders as $folder)
                                                                <option value={{ $folder->id }}
                                                                    @foreach ($title->wishes as $wish)
                                                                        @isset($wish->folder_id)
                                                                            {{ $wish->folder_id == $folder->id ? 'selected="selected"' : '' }}
                                                                        @endisset @endforeach>
                                                                    {{ $folder->nombre }}</option>
                                                            @endforeach
                                                        </select>

                                                    </div>
                                                    </form>
                                                    @endif
                                                    @endif
                                                    <br>
                                                    <a style="color: black; text-decoration:none"
                                                        href="{{ route('wishes.index') }}">
                                                        <strong>Go to your Wishlist</strong>
                                                    </a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card border-success">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-lg-5 form-group">
                                                        <strong>Average Rating:</strong>
                                                        {{-- {{ $title->valoracion }} --}}
                                                    </div>
                                                    <div class="col-lg-7">
                                                       
                                                        @for ($i = 1; $i < 6; $i++)
                                                            @if ($title->valoracion >= $i)
                                                                <i id="redstar{{ $i }}"
                                                                    class="fa-solid fa-star"
                                                                    style="color: green;"></i>
                                                            @else
                                                                <i id="redstar{{ $i }}"
                                                                    class="fa-regular fa-star"
                                                                    ></i>
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
                        <div class="card">
                            <div class="card-header">
                                <strong>More Images:</strong>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <?php
                                $aux_imagen = 'media\\' . 'no_available.jpg';
                                foreach ($title->images as $i) {
                                    //if ($i->filename == 'front.jpg') {
                                        $aux_imagen = 'media\\' . $title->id . '\\' . $i->filename;
                                    //}
                                ?>
                                    <div class="col-sm-6 col-md-3 col-lg-2">
                                        <img src="{{ asset($aux_imagen) }}"
                                            alt="{{ $title->artista . ' ' . $title->titulo }}" width="100%">
                                    </div>
                                    <?php
                                }
                                ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="{{ asset('js/recordar.js') }}"></script>
@endsection
