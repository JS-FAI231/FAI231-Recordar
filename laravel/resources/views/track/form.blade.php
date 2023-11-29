<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Titulo') }}
            @isset($track->title->id)
                <select class="form-control" name="title_id" value="{{ old('title_id') }}">
                    <option value=""></option>
                    <option value="{{ $track->title_id }}"
                        {{ $track->title_id == $track->title->id ? 'selected="selected"' : '' }}>
                        {{ $track->title->artista }} {{ $track->title->titulo }}
                    </option>
                </select>
            @else
                {{ Form::text('title_id', $track->title_id, ['class' => 'form-control' . ($errors->has('title_id') ? ' is-invalid' : ''), 'placeholder' => 'Title Id']) }}
            @endisset
            {!! $errors->first('title_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('track') }}
            {{ Form::text('track', $track->track, ['class' => 'form-control' . ($errors->has('track') ? ' is-invalid' : ''), 'placeholder' => 'Track']) }}
            {!! $errors->first('track', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $track->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('duracion') }}
            {{ Form::text('duracion', $track->duracion, ['class' => 'form-control' . ($errors->has('duracion') ? ' is-invalid' : ''), 'placeholder' => 'Duracion']) }}
            {!! $errors->first('duracion', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('path') }}
            {{ Form::text('path', $track->path, ['class' => 'form-control' . ($errors->has('path') ? ' is-invalid' : ''), 'placeholder' => 'Path']) }}
            {!! $errors->first('path', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('filename') }}
            {{ Form::text('filename', $track->filename, ['class' => 'form-control' . ($errors->has('filename') ? ' is-invalid' : ''), 'placeholder' => 'Filename']) }}
            {!! $errors->first('filename', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            <label for="filetrack">Select a file:</label>
            <input type="file" id="filetrack" name="filetrack"><br><br>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
