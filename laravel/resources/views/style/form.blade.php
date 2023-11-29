<div class="box box-info padding-1">
    <div class="box-body">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('estilo') }}
                    {{ Form::text('estilo', $style->estilo, ['class' => 'form-control' . ($errors->has('estilo') ? ' is-invalid' : ''), 'placeholder' => 'Estilo']) }}
                    {!! $errors->first('estilo', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('Genero') }}
                    {{-- {{ Form::text('gender_id', $style->gender_id, ['class' => 'form-control' . ($errors->has('gender_id') ? ' is-invalid' : ''), 'placeholder' => 'Gender Id']) }} --}}
                    <select class="form-select" name="gender_id" value="{{ old('gender_id') }}">
                        <option value=""></option>
                        @foreach ($genders as $gender)
                            <option value="{{ $gender->id }}"
                                {{ $style->gender_id == $gender->id ? 'selected="selected"' : '' }}>
                                {{ $gender->genero }}
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first('gender_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        

        
    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
