@extends('layouts.app')

@section('template_title')
    Title
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Title') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('titles.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
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
                                        <th>No</th>
                                        
										<th>Artista</th>
										<th>Titulo</th>
										<th>Formato</th>
										<th>Pais</th>
										<th>Catalogo</th>
										<th>Sello</th>
										<th>Estilo</th>
										<th>Released</th>
										{{-- <th>Creditos</th>
										<th>Notas</th>
										<th>Review</th>
										<th>Version Id</th> --}}

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($titles as $title)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $title->artista }}</td>
											<td>{{ $title->titulo }}</td>
											<td>{{ $title->format->formato }} {{ $title->format->descripcion }}</td>
											<td>{{ $title->country->nombre }}</td>
											<td>{{ $title->catalogo }}</td>
											<td>{{ $title->sello }}</td>
											<td>{{ $title->style->estilo }}</td>
											<td>{{ $title->released }}</td>
											{{-- <td>{{ $title->creditos }}</td>
											<td>{{ $title->notas }}</td>
											<td>{{ $title->review }}</td>
											<td>{{ $title->version_id }}</td> --}}

                                            <td>
                                                <form action="{{ route('titles.destroy',$title->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('titles.show',$title->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('titles.edit',$title->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $titles->links() !!}
            </div>
        </div>
    </div>
@endsection
