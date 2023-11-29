@extends('layouts.app')

@section('template_title')
    Track
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Track') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('tracks.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        <th>Artista</th>
										<th>Titulo</th>
										{{-- <th>Track</th>
										<th>Nombre</th>
										<th>Duracion</th> --}}
										<th>Path</th>
										<th>Filename</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tracks as $track)
                                        <tr>
                                            <td>{{ $track->title->artista }}</td>
											<td>{{ $track->title->titulo }}</td>
											{{-- <td>{{ $track->track }}</td>
											<td>{{ $track->nombre }}</td>
											<td>{{ $track->duracion }}</td> --}}
											<td>{{ $track->path }}</td>
											<td>{{ $track->filename }}</td>

                                            <td>
                                                <form action="{{ route('tracks.destroy',$track->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('tracks.show',$track->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('tracks.edit',$track->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $tracks->links() !!}
            </div>
        </div>
    </div>
@endsection
