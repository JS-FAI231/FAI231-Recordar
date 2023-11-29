@extends('layouts.app')

@section('template_title')
    Submissions
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Submission') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('submissions.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        
                                        
										
										<th>Demand Id</th>
										<th>Titulo</th>
										<th>Respondido por</th>
                                        <th>Comentario</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($submissions as $submission)
                                        <tr>
                                            
                                            
											
											<td>({{ $submission->demand_id }}) {{ $submission->demand->nombre }}</td>
											<td>@isset($submission->title) {{ $submission->title->titulo }}@endisset </td>
											<td>{{ $submission->user->name }}</td>
                                            <td>{{ $submission->comentario }}</td>
                                            <td>
                                                <form action="{{ route('submissions.destroy',$submission->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('submissions.show',$submission->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('submissions.edit',$submission->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
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
                {!! $submissions->links() !!}
            </div>
        </div>
    </div>
@endsection
