@extends('layouts.app')

@section('template_title')
    Demand
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Demand') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('demands.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
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

                                        <th>User</th>
                                        <th>Nombre</th>
                                        <th>Status</th>
                                        <th>Style Id</th>

                                        <th>Title ID</th>
                                        <th>Submition</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demands as $demand)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $demand->user->name }}</td>
                                            <td>{{ $demand->nombre }}</td>
                                            <td>{{ $demand->status }}</td>
                                            <td>{{ $demand->style_id }}</td>
                                            <td>
                                            @foreach($demand->submissions as $submission)    
                                                <strong><a href="{{ route('main.show',$submission->title_id) }}"> {{ $submission->title->titulo }}</a><strong>
                                                
                                            @endforeach
                                            </td>
                                            <td>
                                                @if ($demand->status=='Open')
                                                <form action="{{ route('submissions.create') }}" method="GET">
                                                    <input type="hidden" name="nombre" id='nombre' value="{{ $demand->nombre }} ">
                                                    <input type="hidden" name="demand_id" id='demand_id' value="{{ $demand->id }} ">
                                                    <button type="submit" class="btn btn-sm btn-success" 
                                                        href="{{ route('submissions.create') }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ 'Atender' }}</button>
                                                </form>
                                                @else
                                                @foreach($demand->submissions as $submission)    
                                                
                                                <strong><a href="{{ route('submissions.show',$submission->id) }}"> Done </a><strong>
                                            @endforeach
                                                @endif
                                            </td>
                                            <td>
                                                @if ($demand->status=='Open')
                                                <form action="{{ route('demands.destroy', $demand->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('demands.show', $demand->id) }}"><i
                                                            class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('demands.edit', $demand->id) }}"><i
                                                            class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $demands->links() !!}
            </div>
        </div>
    </div>
@endsection
