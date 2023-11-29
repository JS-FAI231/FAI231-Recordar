<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('log_name') }}
            {{ Form::text('log_name', $activityLog->log_name, ['class' => 'form-control' . ($errors->has('log_name') ? ' is-invalid' : ''), 'placeholder' => 'Log Name']) }}
            {!! $errors->first('log_name', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('description') }}
            {{ Form::text('description', $activityLog->description, ['class' => 'form-control' . ($errors->has('description') ? ' is-invalid' : ''), 'placeholder' => 'Description']) }}
            {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('subject_type') }}
            {{ Form::text('subject_type', $activityLog->subject_type, ['class' => 'form-control' . ($errors->has('subject_type') ? ' is-invalid' : ''), 'placeholder' => 'Subject Type']) }}
            {!! $errors->first('subject_type', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('event') }}
            {{ Form::text('event', $activityLog->event, ['class' => 'form-control' . ($errors->has('event') ? ' is-invalid' : ''), 'placeholder' => 'Event']) }}
            {!! $errors->first('event', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('subject_id') }}
            {{ Form::text('subject_id', $activityLog->subject_id, ['class' => 'form-control' . ($errors->has('subject_id') ? ' is-invalid' : ''), 'placeholder' => 'Subject Id']) }}
            {!! $errors->first('subject_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('causer_type') }}
            {{ Form::text('causer_type', $activityLog->causer_type, ['class' => 'form-control' . ($errors->has('causer_type') ? ' is-invalid' : ''), 'placeholder' => 'Causer Type']) }}
            {!! $errors->first('causer_type', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('causer_id') }}
            {{ Form::text('causer_id', $activityLog->causer_id, ['class' => 'form-control' . ($errors->has('causer_id') ? ' is-invalid' : ''), 'placeholder' => 'Causer Id']) }}
            {!! $errors->first('causer_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('properties') }}
            {{ Form::text('properties', $activityLog->properties, ['class' => 'form-control' . ($errors->has('properties') ? ' is-invalid' : ''), 'placeholder' => 'Properties']) }}
            {!! $errors->first('properties', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('batch_uuid') }}
            {{ Form::text('batch_uuid', $activityLog->batch_uuid, ['class' => 'form-control' . ($errors->has('batch_uuid') ? ' is-invalid' : ''), 'placeholder' => 'Batch Uuid']) }}
            {!! $errors->first('batch_uuid', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>