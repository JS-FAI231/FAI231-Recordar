<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('user_id') }}
            {{ Form::text('user_id', $wish->user_id, ['class' => 'form-control' . ($errors->has('user_id') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
            {!! $errors->first('user_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('title_id') }}
            {{ Form::text('title_id', $wish->title_id, ['class' => 'form-control' . ($errors->has('title_id') ? ' is-invalid' : ''), 'placeholder' => 'Title Id']) }}
            {!! $errors->first('title_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('folder_id') }}
            {{ Form::text('folder_id', $wish->folder_id, ['class' => 'form-control' . ($errors->has('folder_id') ? ' is-invalid' : ''), 'placeholder' => 'Folder Id']) }}
            {!! $errors->first('folder_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>