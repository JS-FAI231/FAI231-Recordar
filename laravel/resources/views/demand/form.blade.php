<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="row">
            <p>All fields are required.</p>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    {{ Form::label('Style') }}
                    {{-- {{ Form::text('style_id', $demand->style_id, ['class' => 'form-control' . ($errors->has('style_id') ? ' is-invalid' : ''), 'placeholder' => 'Style']) }} --}}
                    <select class="form-control" name="style_id" value="{{ old('style_id') }}">
                        <option value=""></option>
                        @foreach ($styles as $style)
                            <option value="{{ $style->id }}"
                                {{ $demand->style_id == $style->id ? 'selected="selected"' : '' }}>
                                {{ $style->estilo }}
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first('style_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-3">
            </div>
            <div class="col-3">
                <div class="form-group">
                    {{ Form::label('Logged User') }}
                    {{ Form::text('user_id', $demand->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id', 'hidden' ]) }}
                    {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
                    <br>
                    <strong>{{ $demand->user->name }}</strong>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-9">
                <div class="form-group">
                    {{ Form::label('Name') }}
                    {{ Form::text('nombre', $demand->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Name']) }}
                    {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-3">
                <div class="form-group">
                    {{ Form::label('status') }}
                    {{ Form::text('status', $demand->status, ['class' => 'form-control' . ($errors->has('status') ? ' is-invalid' : ''), 'placeholder' => 'Status', 'readonly']) }}
                    {!! $errors->first('status', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>

        
        
        
        

    </div>
    <br>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>