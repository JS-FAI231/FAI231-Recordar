<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('Titulo') }}
            @isset($image->title->id)
                <select class="form-control" name="title_id" value="{{ old('title_id') }}">
                    <option value=""></option>
                    <option value="{{ $image->title_id }}"
                        {{ $image->title_id == $image->title->id ? 'selected="selected"' : '' }}>
                        {{ $image->title->artista }} {{ $image->title->titulo }}
                    </option>
                </select>
            @else
                {{ Form::text('title_id', $image->title_id, ['class' => 'form-control' . ($errors->has('title_id') ? ' is-invalid' : ''), 'placeholder' => 'Title Id']) }}
            @endisset

            {!! $errors->first('title_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('path') }}
            {{ Form::text('path', $image->path, ['class' => 'form-control' . ($errors->has('path') ? ' is-invalid' : ''), 'placeholder' => 'Path']) }}
            {!! $errors->first('path', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('filename') }}
            {{ Form::text('filename', $image->filename, ['class' => 'form-control' . ($errors->has('filename') ? ' is-invalid' : ''), 'placeholder' => 'Filename']) }}
            {!! $errors->first('filename', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <br>
        <div class="form-group">
            <label for="image">Select a file:</label>
            <input type="file" id="image" name="image"><br><br>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
