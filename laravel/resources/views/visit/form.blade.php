<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('updated_ar') }}
            {{ Form::text('updated_ar', $visit->updated_ar, ['class' => 'form-control' . ($errors->has('updated_ar') ? ' is-invalid' : ''), 'placeholder' => 'Updated Ar']) }}
            {!! $errors->first('updated_ar', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('title_id') }}
            {{ Form::text('title_id', $visit->title_id, ['class' => 'form-control' . ($errors->has('title_id') ? ' is-invalid' : ''), 'placeholder' => 'Title Id']) }}
            {!! $errors->first('title_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('comentario') }}
            {{ Form::text('comentario', $visit->comentario, ['class' => 'form-control' . ($errors->has('comentario') ? ' is-invalid' : ''), 'placeholder' => 'Comentario']) }}
            {!! $errors->first('comentario', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>