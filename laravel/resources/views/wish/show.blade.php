@extends('layouts.app')

@section('template_title')
    {{-- {{ $wish->name ?? "{{ __('Show') Wish" }} --}}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Wish</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('wishes.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>User Id:</strong>
                            {{ $wish->user_id }}
                        </div>
                        <div class="form-group">
                            <strong>Title Id:</strong>
                            {{ $wish->title_id }}
                            
                        </div>
                        <div class="form-group">
                            <strong>Folder Id:</strong>
                            {{ $wish->folder_id }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
