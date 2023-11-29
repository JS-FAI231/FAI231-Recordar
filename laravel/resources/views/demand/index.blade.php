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
                                <strong>{{ __('Requests') }}</strong>
                            </span>

                            <div class="float-right">
                                <a href="{{ route('demands.create') }}" style="text-decoration: none; color:black">
                                    <strong>New Request</strong>
                                </a>
                                {{-- <a href="{{ route('demands.create') }}" class="btn btn-primary btn-sm float-right"
                                    data-placement="left">
                                    {{ __('New Request') }}
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

                                        <th>Style</th>
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>User</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($demands as $demand)
                                        <tr @if(count($demand->submissions)) style="background-color: #cac7d1"@endif>
                                            {{-- <td>{{ ++$i }}</td> --}}
                                            @if ($demand->style_id)
                                                <td>{{ $demand->style->estilo }}</td>
                                            @else
                                                <td></td>
                                            @endif

                                            <td>
                                                <a href="{{ route('demands.show', $demand->id) }}"
                                                    style="text-decoration: none; color:black">
                                                    <strong>{{ $demand->nombre }}</strong>
                                                </a>
                                            </td>

                                            <td>
                                            @if(count($demand->submissions))
                                                {{ count($demand->submissions) }} Messages
                                            @else
                                                Open
                                            @endif
                                            </td>

                                            <td>
                                                {{ $demand->user->name }}
                                                
                                            </td>

                                            <td>
                                                <form action="{{ route('demands.destroy', $demand->id) }}" method="POST">
                                                    @if ($demand->user_id == Auth::user()->id)
                                                        <a class="btn btn-sm btn-success"
                                                            href="{{ route('demands.edit', $demand->id) }}"><i
                                                                class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm"><i
                                                                class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                    @endif
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $demands->appends(request()->input())->links() !!}
            </div>
        </div>
    </div>
@endsection
