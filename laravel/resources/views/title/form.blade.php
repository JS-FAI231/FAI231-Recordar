<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('artista') }}
                    {{ Form::text('artista', $title->artista, ['class' => 'form-control' . ($errors->has('artista') ? ' is-invalid' : ''), 'placeholder' => 'Artista']) }}
                    {!! $errors->first('artista', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('titulo') }}
                    {{ Form::text('titulo', $title->titulo, ['class' => 'form-control' . ($errors->has('titulo') ? ' is-invalid' : ''), 'placeholder' => 'Titulo']) }}
                    {!! $errors->first('titulo', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-1">
                <div class="form-group">
                    {{ Form::label('valoracion') }}
                    {{ Form::text('valoracion', $title->valoracion, ['class' => 'form-control' . ($errors->has('valoracion') ? ' is-invalid' : ''), 'placeholder' => 'Valoracion', 'default' => '0']) }}
                    {!! $errors->first('valoracion', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
        <div class="row" style="height: 40px">
        </div>

        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    {{ Form::label('format_id') }}
                    {{-- {{ Form::select('format_id', $formats, ['class' => 'form-control' . ($errors->has('format_id') ? ' is-invalid' : ''), 'placeholder' => 'Format Id']) }} --}}

                    <select class="form-select" name="format_id" value="{{ old('format_id') }}">
                        <option value=""></option>
                        @foreach ($formats as $format)
                            <option value="{{ $format->id }}"
                                {{ $title->format_id == $format->id ? 'selected="selected"' : '' }}>
                                {{ $format->descripcion . ' ' . $format->formato }}
                            </option>
                        @endforeach
                    </select>

                    {!! $errors->first('format_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('country_id') }}
                    {{-- {{ Form::text('country_id', $title->country_id, ['class' => 'form-control' . ($errors->has('country_id') ? ' is-invalid' : ''), 'placeholder' => 'Country Id']) }} --}}
                    <select class="form-select" name="country_id" value="{{ old('country_id') }}">
                        <option value=""></option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}"
                                {{ $title->country_id == $country->id ? 'selected="selected"' : '' }}>
                                {{ $country->nombre }}
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first('country_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('catalogo') }}
                    {{ Form::text('catalogo', $title->catalogo, ['class' => 'form-control' . ($errors->has('catalogo') ? ' is-invalid' : ''), 'placeholder' => 'Catalogo']) }}
                    {!! $errors->first('catalogo', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('sello') }}
                    {{ Form::text('sello', $title->sello, ['class' => 'form-control' . ($errors->has('sello') ? ' is-invalid' : ''), 'placeholder' => 'Sello']) }}
                    {!! $errors->first('sello', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('style_id') }}
                    {{-- {{ Form::text('style_id', $title->style_id, ['class' => 'form-control' . ($errors->has('style_id') ? ' is-invalid' : ''), 'placeholder' => 'Style Id']) }} --}}
                    <select class="form-select" name="style_id" value="{{ old('style_id') }}">
                        <option value=""></option>
                        @foreach ($styles as $style)
                            <option value="{{ $style->id }}"
                                {{ $title->style_id == $style->id ? 'selected="selected"' : '' }}>
                                {{ $style->estilo . ' - ' . $style->gender->genero }}
                            </option>
                        @endforeach
                    </select>
                    {!! $errors->first('style_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('released') }}
                    {{ Form::text('released', $title->released, ['class' => 'form-control' . ($errors->has('released') ? ' is-invalid' : ''), 'placeholder' => 'Released']) }}
                    {!! $errors->first('released', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    {{ Form::label('Select Images') }}
                    <input type="file" id="image" name="image[]" multiple class="form-control"><br>
                    <div id='info_images'>
                    </div>
                    <br>
                </div>
                <div class="form-group">
                    {{ Form::label('Select Tracks') }}
                    <input type="file" id="tracks" name="tracks[]" multiple class="form-control"><br>
                    <div id='info_tracks'>
                    </div>
                    <br>
                </div>
                
            </div>

            <div class="col-md-5">
                <div class="form-group">
                    {{ Form::label('creditos') }}
                    {{ Form::text('creditos', $title->creditos, ['class' => 'form-control' . ($errors->has('creditos') ? ' is-invalid' : ''), 'placeholder' => 'Creditos']) }}
                    {!! $errors->first('creditos', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="form-group">
                    {{ Form::label('version_id') }}
                    {{ Form::text('version_id', $title->version_id, ['class' => 'form-control' . ($errors->has('version_id') ? ' is-invalid' : ''), 'placeholder' => 'Version Id']) }}
                    {!! $errors->first('version_id', '<div class="invalid-feedback">:message</div>') !!}
                </div>

                <div class="form-group">
                    {{ Form::label('notas') }}
                    {{ Form::textarea('notas', $title->notas, ['class' => 'form-control' . ($errors->has('notas') ? ' is-invalid' : ''), 'placeholder' => 'Notas', 'rows' => '3']) }}
                    {!! $errors->first('notas', '<div class="invalid-feedback">:message</div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('review') }}
                    {{ Form::textarea('review', $title->review, ['class' => 'form-control' . ($errors->has('review') ? ' is-invalid' : ''), 'placeholder' => 'Review', 'rows' => '5']) }}
                    {!! $errors->first('review', '<div class="invalid-feedback">:message</div>') !!}
                </div>

            </div>
        </div>
    </div>
    <div class="row" style="height: 20px">
        
    </div>
    
    <div class="row" style="display: flex; justify-content: space-between; align-items: center;">
        <div class="col-md-2">
            <div class="box-footer mt20">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
            </div>
        </div>
        <div class="col-md-10">
            <div class="form-group">
                <div class="progress">
                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar"
                        aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </div>
    
</div>
<script>
    //Progress Bar
    $(function() {
        $(document).ready(function() {

            var message = $('.success__msg');
            $('#fileUploadForm').ajaxForm({
                beforeSend: function() {
                    var percentage = '0';
                },
                uploadProgress: function(event, position, total, percentComplete) {
                    var percentage = percentComplete;
                    $('.progress .progress-bar').css("width", percentage + '%', function() {
                        return $(this).attr("aria-valuenow", percentage) + "%";
                    })
                },
                complete: function(xhr) {
                    window.location.href="{{ url('/') }}";

                }
                
            });
        });
    })

    //Control Tracks and Images

    let tracks = document.getElementById("tracks");
    let info_tracks = document.getElementById("info_tracks");

    let image = document.getElementById("image");
    let info_images = document.getElementById("info_images");

    image.addEventListener('change', function(e) {
        selectedFiles = e.target.files;

        while (info_images.firstChild) {
            info_images.removeChild(info_images.firstChild);
        }

        for (const element of selectedFiles) {
            console.log(element);

            const br = document.createElement("br");
            const filename = document.createTextNode(element.name);
            const filesize = document.createTextNode(' ' + Math.round(element.size / 1024) + ' KB');

            //info_images.appendChild(filename);
            //info_images.appendChild(filesize);


            let url = URL.createObjectURL(element);
            let img = new Image();
            img.src = url;

            aux_image = info_images.appendChild(img);

            aux_image.setAttribute('width', '80px');
            aux_image.setAttribute('height', '80px');
            aux_image.setAttribute('style', 'margin:5px')
            //info_images.appendChild(br);

        };

    });

    tracks.addEventListener('change', function(e) {
        selectedFiles = e.target.files;

        while (info_tracks.firstChild) {
            info_tracks.removeChild(info_tracks.firstChild);
        }

        for (const element of selectedFiles) {
            //console.log(element);

            const br = document.createElement("br");
            const filename = document.createTextNode(element.name);
            const filesize = document.createTextNode(' ' + Math.round(element.size / 1048576) + ' MB');

            info_tracks.appendChild(filename);
            info_tracks.appendChild(filesize);
            info_tracks.appendChild(br);
        };

    });
</script>
