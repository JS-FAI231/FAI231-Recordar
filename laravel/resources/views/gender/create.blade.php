@extends('layouts.app')

@section('template_title')
    {{ __('Create') }} Gender
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">{{ __('Create') }} Gender</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('genders.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('gender.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
