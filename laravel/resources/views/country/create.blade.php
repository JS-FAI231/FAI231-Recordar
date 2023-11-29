@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Country
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Country</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('countries.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('country.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
