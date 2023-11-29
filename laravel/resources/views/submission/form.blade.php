<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-5">
                <div class="form-group">
                    {{ Form::label('demand_id') }}
                    @isset($submission->demand->id)
                        <select class="form-control" name="demand_id" value="{{ old('demand_id') }}">
                            <option value=""></option>
                            <option value="{{ $submission->demand_id }}"
                                {{ $submission->demand_id == $submission->demand->id ? 'selected="selected"' : '' }}>
                                ({{ $submission->demand_id }}) {{ $submission->demand->nombre }}
                            </option>
                        </select>
                    @else
                        {{ Form::text('demand_id', $submission->demand_id, ['class' => 'form-control' . ($errors->has('demand_id') ? ' is-invalid' : ''), 'placeholder' => 'Demand Id']) }}
                    @endisset
                    {!! $errors->first('demand_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    {{ Form::label('Respondido por') }}
                    @isset($submission->user->id)
                        <select class="form-control" name="user_id" value="{{ old('user_id') }}">
                            <option value=""></option>
                            <option value="{{ $submission->user_id }}"
                                {{ $submission->user_id == $submission->user->id ? 'selected="selected"' : '' }}>
                                ({{ $submission->user_id }}) {{ $submission->user->name }}
                            </option>
                        </select>
                    @else
                        {{ Form::text('user_id', $submission->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
                    @endisset
                    {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    {{ Form::label('Titulo') }}
                    {{-- {{ Form::text('title_id', $submission->title_id, ['class' => 'form-control' . ($errors->has('title_id') ? ' is-invalid' : ''), 'placeholder' => 'Title Id']) }} --}}
                    <select class="form-control" name="title_id" value="{{ old('title_id') }}">
                        <option value=""></option>
                        @isset($titles)
                            @foreach ($titles as $title)
                                <option value="{{ $title->id }}"
                                    {{ $submission->title_id == $title->id ? 'selected="selected"' : '' }}>
                                    {{ $title->artista }} {{ $title->titulo }} 
                                    ({{ $title->format->formato }} {{ $title->format->descripcion }} {{ $title->catalogo }})
                                    
                                </option>
                            @endforeach
                        @else
                            <option value="{{ $submission->title->id }}"
                                {{ $submission->title_id == $submission->title->id ? 'selected="selected"' : '' }}>
                                {{ $submission->title->artista }} - {{ $submission->title->titulo }} 
                                ({{ $submission->title->format->formato }} 
                                {{ $submission->title->format->descripcion }} 
                                {{ $submission->title->catalogo }})

                            </option>
                        @endisset
                    </select>
                    {!! $errors->first('title_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            
        </div>

        
        
        <div class="form-group">
            {{ Form::label('comentario') }}
            {{ Form::text('comentario', $submission->comentario, ['class' => 'form-control' . ($errors->has('comentario') ? ' is-invalid' : ''), 'placeholder' => 'Comentario']) }}
            {!! $errors->first('comentario', '<div class="invalid-feedback">:message</div>') !!}
        </div>

        

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
