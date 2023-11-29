
<a class="dropdown-item" href="{{ route('users.index') }}">Usuarios</a>


<a class="dropdown-item" href="{{ route('genders.index') }}">Generos</a>
<a class="dropdown-item" href="{{ route('styles.index') }}">Estilos</a>
<a class="dropdown-item" href="{{ route('countries.index') }}">Paises</a>
<a class="dropdown-item" href="{{ route('formats.index') }}">Formatos</a>

<a class="dropdown-item" href="{{ route('titles.index') }}">Titulos</a>
<a class="dropdown-item" href="{{ route('tracks.index') }}">Tracks</a>
<a class="dropdown-item" href="{{ route('images.index') }}">Imagenes</a>

<a class="dropdown-item" href="{{ route('folders.index') }}">Carpetas</a>
<a class="dropdown-item" href="{{ route('wishes.index') }}">Deseos</a>
<a class="dropdown-item" href="{{ route('submissions.index') }}">Publicaciones</a>
<a class="dropdown-item" href="{{ route('demands.index') }}">Pedidos</a>
<a class="dropdown-item" href="{{ route('visits.index') }}">Visitas</a>

<a class="dropdown-item" href="{{ route('activitylogs.index') }}">Actividad</a>

{{-- 
@can('Admin.menu')
<a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a>
<a class="dropdown-item" href="{{ route('permissions.index') }}">Permisos</a>
@endcan
--}}