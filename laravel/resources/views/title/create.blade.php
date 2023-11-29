@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Title
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Title</span>
                    </div>
                    <div class="card-body">
                        <form id="fileUploadForm" method="POST" action="{{ route('titles.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('title.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
