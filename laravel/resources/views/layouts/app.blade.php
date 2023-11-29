<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery.form_4.3.0.min.js') }}"></script>
    <script src="{{ asset('js/recordar_style.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm"
            style='background-image: url("/docs-blur-header.jpg")'>
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{-- {{ config('app.name', 'Laravel') }} --}}
                    <img src="{{ asset('imagenes/record-ar.png') }}" alt="Recordar Home Page" width="60%">
                </a>

                <div class="col-md-7 d-flex justify-content-center">
                    {{-- <strong> --}}
                    {{-- <h6> --}}
                    <a style="color: black; text-decoration:none" href="{{ route('demands.index') }}"
                        onMouseOver="coloron(this)"
                        onMouseOut="coloroff(this)"><strong>Pedidos</strong></a>{!! '&nbsp;' !!}|{!! '&nbsp;' !!}
                    <a style="color: black; text-decoration:none" href="{{ route('wishes.index') }}"
                        onMouseOver="coloron(this)"
                        onMouseOut="coloroff(this)"><strong>Favoritos</strong></a>{!! '&nbsp;' !!}|{!! '&nbsp;' !!}
                    <a style="color: black; text-decoration:none" href="{{ route('folders.index') }}"
                        onMouseOver="coloron(this)"
                        onMouseOut="coloroff(this)"><strong>Carpetas</strong></a>{!! '&nbsp;' !!}|{!! '&nbsp;' !!}
                    <a style="color: black; text-decoration:none" href="{{ route('titles.create') }}"
                        onMouseOver="coloron(this)" onMouseOut="coloroff(this)">
                        <strong>Agregar Titulo</strong></a>
                    {{-- </h6> --}}
                    {{-- </strong> --}}
                </div>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        {{-- @include('layouts.searchbar') --}}
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}

                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">


                                    @include('layouts.items_menu')

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>

                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- Footer -->
    <footer class="text-center text-lg-start text-dark" style="background-color: #ECEFF1">
        <!-- Section: Social media -->
        <section class="d-flex justify-content-between p-1 text-white" style="background-color: #7f7c86">

        </section>
        <!-- Section: Social media -->

        <!-- Section: Links  -->
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <!-- Grid row -->
                <div class="row mt-3">
                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <!-- Content -->
                        <h6 class="text-uppercase fw-bold">RECORD-AR</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            Sitio colaborativo destinado a coleccionistas de música electrónica.
                        </p>
                        <p>
                            Entretenimiento, intercambios e información de títulos.
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Otros Sitios</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            <a href="https://lossless-music.org/home" class="text-dark">Loosless-Music.Org</a>
                        </p>
                        <p>
                            <a href="https://www.qobuz.com/ie-en/shop" class="text-dark">Qobuz</a>
                        </p>
                        <p>
                            <a href="https://magicjuanm7.blogspot.com/" class="text-dark">Missing Hits</a>
                        </p>
                        <p>
                            <a href="https://housemusicportugal.wordpress.com/" class="text-dark">Portugal House
                                Music</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Links Utiles</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p>
                            <a style="color: black; text-decoration:none"
                                href="{{ route('activitylogs.index') }}"><strong>Tu Actividad</strong></a>
                        </p>
                        <p>
                            <a style="color: black; text-decoration:none"
                                href="{{ route('searchSoapLyrics') }}"><strong>SOAP Lyrics</strong></a>
                        </p>
                        <p>
                            <a style="color: black; text-decoration:none"
                                href="{{ route('searchDeezerApi') }}"><strong>Deezer API</strong></a>
                        </p>
                        <p>
                            <a style="color: black; text-decoration:none"
                                href="{{ route('searchSpotifyApi') }}"><strong>Spotyfi API</strong></a>
                        </p>
                        
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <!-- Links -->
                        <h6 class="text-uppercase fw-bold">Contacto</h6>
                        <hr class="mb-4 mt-0 d-inline-block mx-auto"
                            style="width: 60px; background-color: #7c4dff; height: 2px" />
                        <p><i class="fas fa-home mr-3"></i> Neuquen Capital, Neuquen, ARG</p>
                        <p><i class="fas fa-envelope mr-3"></i> jorge.segura@est.fi.uncoma.edu.ar</p>
                        <p><i class="fas fa-phone mr-3"></i> +54 9299 4519129</p>
                        {{-- <p><i class="fas fa-print mr-3"></i> + 01 234 567 89</p> --}}
                    </div>
                    <!-- Grid column -->
                </div>
                <!-- Grid row -->
            </div>
        </section>
        <!-- Section: Links  -->

        <!-- Section: Social media -->
        <section class="d-flex justify-content-between p-4 text-white" style="background-color: #7f7c86">
            <!-- Left -->
            <div class="me-5">
                <span>Conectate con nuestras redes sociales:</span>
            </div>
            <!-- Left -->

            <!-- Right -->
            <div>
                <a href="" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-linkedin"></i>
                </a>
                <a href="" class="text-white me-4">
                    <i class="fab fa-github"></i>
                </a>
            </div>
            <!-- Right -->
        </section>
        <!-- Section: Social media -->

        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2023
            <a class="text-dark" href="#">Tecnicatura en Desarrollo Web - UNCOMA - Neuquen - ARG</a>
        </div>
        <!-- Copyright -->
    </footer>
    <!-- Footer -->

</body>

</html>
