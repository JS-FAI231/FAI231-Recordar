@extends('layouts.app')

@section('template_title')
    Country
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Country') }}
                            </span>
                            <form class="form-inline">
                                <div class="row">
                                    

                                    <div class="col-10">
                                        <input name="txtBuscar" class="form-control" type="search"
                                            placeholder="Buscar Pais" aria-label="Search"
                                            @isset($txtBuscar) value="{{ $txtBuscar }}" @endisset>
                                    </div>

                                    <div class="col-2">
                                        <button class="btn btn-sm btn-outline-success" type="submit">Buscar</button>
                                    </div>
                                </div>
                            </form>

                            <div class="float-right">
                                <a href="{{ route('countries.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                        <br>
                        {{-- @include('layouts.searchbar') --}}

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

                                        <th>Nombre</th>
                                        <th>Habilitado</th>
                                        <th>Toggle</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($countries as $country)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $country->nombre }}</td>
                                            <td>{{ $country->deshabilitado }}</td>
                                            <td><i class="fa-solid fa-toggle-on fa-2xl" style="color: #07ab3e;"></i></td>
                                            <td>
                                                {{-- <form action="{{ route('countries.destroy',$country->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('countries.show',$country->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('countries.edit',$country->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $countries->appends(request()->input())->links() !!}
            </div>
        </div>
    </div>
@endsection
