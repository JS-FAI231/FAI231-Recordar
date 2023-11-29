@extends('layouts.app')

@section('template_title')
    Wish
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row" style="align-items: center;">
                            <div class="col-md-2">
                                <span id="card_title">{{ __('My Wishlist') }}</span>
                            </div>

                            <div class="col-md-1">
                                <strong>{{ Form::label('Folders') }}</strong>
                            </div>
                            <div class="col-md-4">
                                <form class="form-inline">
                                    <select class="form-select" name="txtFolder">
                                        <option value=""></option>
                                        @foreach ($folders as $folder)
                                            <option value={{ $folder->id }}>{{ $folder->nombre }}</option>
                                        @endforeach
                                    </select>
                            </div>
                            <div class="col-md-2">
                                <button class="btn btn-sm btn-outline-danger" type="submit">Filtrar</button>
                            </div>
                            </form>
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
                                        <th>Cover</th>
                                        <th>Artist</th>
                                        <th>Title</th>
                                        <th>Folder</th>
                                        <th>Rating</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wishes as $wish)
                                        <tr>
                                            {{-- <td>{{ ++$i }}</td> --}}
                                            <td>
                                                @php $aux_imagen = 'media\\' . 'no_available.jpg' @endphp
                                                @foreach ($wish->title->images as $i)
                                                    @if ($i->filename == 'front.jpg')
                                                        @php $aux_imagen = 'media\\' . $wish->title->id . '\\' . $i->filename @endphp
                                                    @endif
                                                @endforeach
                                                <a href="{{ route('main.show', $wish->title->id) }}">
                                                    <img src="{{ asset($aux_imagen) }}"
                                                        alt="{{ $wish->title->artista . ' ' . $wish->title->titulo }}"
                                                        height="60px">
                                                </a>
                                            </td>

                                            <td>{{ $wish->title->artista }}</td>
                                            <td>{{ $wish->title->titulo }}</td>
                                            <td>
                                                @isset($wish->folder_id)
                                                    {{ $wish->folder->nombre }}
                                                    
                                                @endisset
                                            </td>
                                            <td>
                                                @for ($i = 1; $i < 6; $i++)
                                                    @if ($wish->valoracion >= $i)
                                                        <i id="redstar{{ $wish->id }}{{ $i }}"
                                                            class="fa-solid fa-star"
                                                            onclick="javascript:rateTitle({{ $wish->id }},{{ $wish->title_id }},{{ $i }},'{{ route('rateTitle') }}')"
                                                            style="color: red;"></i>
                                                    @else
                                                        <i id="redstar{{ $wish->id }}{{ $i }}"
                                                            class="fa-regular fa-star"
                                                            onclick="javascript:rateTitle({{ $wish->id }},{{ $wish->title_id }},{{ $i }},'{{ route('rateTitle') }}')"></i>
                                                    @endif
                                                @endfor
                                                {!! '&nbsp;' !!}{!! '&nbsp;' !!}
                                                <i id="redstar{{ $wish->id }}0" class="fa-sharp fa-solid fa-xmark"
                                                    onclick="javascript:rateTitle({{ $wish->id }},{{ $wish->title_id }},'0','{{ route('rateTitle') }}')"></i>
                                            </td>
                                            <td>
                                                <form action="{{ route('wishes.destroy', $wish->id) }}" method="POST">
                                                    {{-- <a class="btn btn-sm btn-primary "
                                                        href="{{ route('wishes.show', $wish->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('wishes.edit', $wish->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a> --}}
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i>
                                                        {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $wishes->links() !!}
            </div>
        </div>
    </div>
    <script src="{{ asset('js/recordar.js') }}"></script>
@endsection
