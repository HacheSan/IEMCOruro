@extends('layouts.app')

@section('content')
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://t2.fr.ltmcdn.com/es/posts/8/8/2/dios_ha_dicho_nunca_te_dejare_nunca_te_abandonare_288_32_600.jpg"
                    alt="" height="500" width="1500">
                <div class="container">
                    <div class="carousel-caption text-left">
                        <h1>Iglesia Evangelica Monte Calvario - Oruro</h1>
                        <p>Con su PJ 458 18 - 19 -1999 Ubicada en Urb Pumas Andinos.</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Registrate Hoy</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://th.bing.com/th/id/R.e66cd375151524fd937db76ed6cf55b8?rik=4LGKf%2bcM22lPnw&pid=ImgRaw&r=0"
                    alt="" height="500" width="1500">
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Iglesia Evangelica Monte Calvario - Oruro.</h1>
                        <p>CCon su PJ 458 18 - 19 -1999 Ubicada en Urb Pumas Andinos</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Aprende Más</a></p>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://th.bing.com/th/id/R.e66cd375151524fd937db76ed6cf55b8?rik=4LGKf%2bcM22lPnw&pid=ImgRaw&r=0"
                    alt="" height="500" width="1500">
                <div class="container">
                    <div class="carousel-caption text-right">
                        <h1>Iglesia Evangelica Monte Calvario - Oruro</h1>
                        <p>Con su PJ 458 18 - 19 -1999 Ubicada en Urb Pumas Andinos.</p>
                        <p><a class="btn btn-lg btn-primary" href="#" role="button">Navegar Por La Galeria</a></p>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
        </a>
    </div>


    <div class="container marketing mt-1">

        <!-- START THE FEATURETTES -->
        @foreach ($activities as $row)
            <hr class="featurette-divider">
            @if ($row->id % 2 == 0)
                <div class="row featurette">
                    <div class="col-md-7">
                        <h2 class="featurette-heading text-center">{{ $row->title }}</h2> <span
                            class="text-muted">{{ $row->created_at }}</span>
                        <p class="lead">{{ $row->description }}</p>
                    </div>
                    <div class="col-md-5">
                        <img class="rounded-circle" src="{{ asset('/storage/actividades/' . $row->image) }}" alt=""
                            height="200">

                    </div>
                </div>
            @else
                <div class="row featurette">
                    <div class="col-md-7 order-md-2">
                        <h2 class="featurette-heading text-center">{{ $row->title }}</h2>
                        <span class="text-muted">{{ $row->created_at }}</span>
                        <p class="lead">{{ $row->description }}</p>
                    </div>
                    <div class="col-md-5 order-md-1">
                        <img class="rounded-circle" src="{{ asset('/storage/actividades/' . $row->image) }}" alt=""
                            height="200">

                    </div>
                </div>
            @endif
        @endforeach
        <hr class="featurette-divider">

    </div><!-- /.container -->
    <section id="our-team">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title wow fadeInDown">Encuentranos en</h2>
                <p class="wow fadeInDown">Oruro - Zona sudeste ubanizacion Pumas Andinos.</p>
            </div>
        </div>


        <div id="mapid" style="width: 100%; height: 400px;"
            class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom"
            tabindex="0">
            <div class="leaflet-pane leaflet-map-pane" style="transform: translate3d(0px, 0px, 0px);">
                <div class="leaflet-pane leaflet-tile-pane">
                    <div class="leaflet-layer " style="z-index: 1; opacity: 1;">
                        <div class="leaflet-tile-container leaflet-zoom-animated"
                            style="z-index: 18; transform: translate3d(0px, 0px, 0px) scale(1);">
                            <img alt="" role="presentation"
                                src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/12/2046/1361?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw"
                                class="leaflet-tile leaflet-tile-loaded"
                                style="width: 512px; height: 512px; transform: translate3d(-200px, -347px, 0px); opacity: 1;">
                            <img alt="" role="presentation"
                                src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/12/2047/1361?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw"
                                class="leaflet-tile leaflet-tile-loaded"
                                style="width: 512px; height: 512px; transform: translate3d(312px, -347px, 0px); opacity: 1;">
                            <img alt="" role="presentation"
                                src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/12/2046/1362?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw"
                                class="leaflet-tile leaflet-tile-loaded"
                                style="width: 512px; height: 512px; transform: translate3d(-200px, 165px, 0px); opacity: 1;">
                            <img alt="" role="presentation"
                                src="https://api.mapbox.com/styles/v1/mapbox/streets-v11/tiles/12/2047/1362?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw"
                                class="leaflet-tile leaflet-tile-loaded"
                                style="width: 512px; height: 512px; transform: translate3d(312px, 165px, 0px); opacity: 1;">
                        </div>
                    </div>
                </div>
                <div class="leaflet-pane leaflet-shadow-pane">
                    <img src="https://unpkg.com/leaflet@1.7.1/dist/images/marker-shadow.png"
                        class="leaflet-marker-shadow leaflet-zoom-animated" alt=""
                        style="margin-left: -12px; margin-top: -41px; width: 41px; height: 41px; transform: translate3d(300px, 247px, 0px);">
                </div>
                <div class="leaflet-pane leaflet-overlay-pane">
                    <svg pointer-events="none" class="leaflet-zoom-animated" width="720" height="480"
                        viewBox="-60 -40 720 480" style="transform: translate3d(-60px, -40px, 0px);">
                        <g>
                            <path class="leaflet-interactive" stroke="red" stroke-opacity="1" stroke-width="3"
                                stroke-linecap="round" stroke-linejoin="round" fill="#f03" fill-opacity="0.5"
                                fill-rule="evenodd"
                                d="M141.20355555554852,171.94704600190744a42,42 0 1,0 84,0 a42,42 0 1,0 -84,0 "></path>
                            <path class="leaflet-interactive" stroke="#3388ff" stroke-opacity="1" stroke-width="3"
                                stroke-linecap="round" stroke-linejoin="round" fill="#3388ff" fill-opacity="0.2"
                                fill-rule="evenodd" d="M358 163L474 219L550 153z"></path>
                        </g>
                    </svg>
                </div>
                <div class="leaflet-pane leaflet-marker-pane">
                    <img src="https://unpkg.com/leaflet@1.7.1/dist/images/marker-icon.png"
                        class="leaflet-marker-icon leaflet-zoom-animated leaflet-interactive" alt="" tabindex="0"
                        style="margin-left: -12px; margin-top: -41px; width: 25px; height: 41px; transform: translate3d(300px, 247px, 0px); z-index: 247;">
                </div>
                <div class="leaflet-pane leaflet-tooltip-pane"></div>
                <div class="leaflet-pane leaflet-popup-pane">
                    <div class="leaflet-popup  leaflet-zoom-animated"
                        style="opacity: 1; transform: translate3d(301px, 213px, 0px); bottom: -7px; left: -57px;">
                        <div class="leaflet-popup-content-wrapper">
                            <div class="leaflet-popup-content" style="width: 74px;">
                                <b>Hello world!</b>
                                <br>I am a popup.
                            </div>
                        </div>
                        <div class="leaflet-popup-tip-container">
                            <div class="leaflet-popup-tip"></div>
                        </div>
                        <a class="leaflet-popup-close-button" href="#close">×</a>
                    </div>
                </div>
                <div class="leaflet-proxy leaflet-zoom-animated"
                    style="transform: translate3d(1.04805e+06px, 697379px, 0px) scale(4096);">
                </div>
            </div>
            <div class="leaflet-control-container">
                <div class="leaflet-top leaflet-left">
                    <div class="leaflet-control-zoom leaflet-bar leaflet-control">
                        <a class="leaflet-control-zoom-in" href="#" title="Zoom in" role="button" aria-label="Zoom in">+</a>
                        <a class="leaflet-control-zoom-out" href="#" title="Zoom out" role="button"
                            aria-label="Zoom out">−</a>
                    </div>
                </div>
            </div>

    </section>
@endsection

<!-- CSS -->
@section('css')
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="shortcut icon" href="images/ico/favicon.ico">
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="">

@endsection
<!-- JS -->
@section('js')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
    <script>
        var mymap = L.map('mapid').setView([-18.033594,-67.019264], 14);

        L.tileLayer(
            'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                maxZoom: 18,
                attribution: '',
                id: 'mapbox/streets-v11',
                tileSize: 512,
                zoomOffset: -1
            }).addTo(mymap);

        L.marker([-18.033594,-67.019264]).addTo(mymap)
            .bindPopup("<b>IGLESIA EVANGÉLICA MONTE CALVARIO</b><br/>Oruro.").openPopup();


        var popup = L.popup();

        function onMapClick(e) {
            popup
                .setLatLng(e.latlng)
                .setContent("Precionaste el mapa en: " + e.latlng.toString())
                .openOn(mymap);
        }

        mymap.on('click', onMapClick);
    </script>
@endsection
