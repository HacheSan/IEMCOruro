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
            <img src="https://t2.fr.ltmcdn.com/es/posts/8/8/2/dios_ha_dicho_nunca_te_dejare_nunca_te_abandonare_288_32_600.jpg" alt="" height="500" width="1500">
            <div class="container">
                <div class="carousel-caption text-left">
                    <h1>Iglesia Evangelica Monte Calvario - Oruro</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://th.bing.com/th/id/R.e66cd375151524fd937db76ed6cf55b8?rik=4LGKf%2bcM22lPnw&pid=ImgRaw&r=0" alt="" height="500" width="1500">
            <div class="container">
                <div class="carousel-caption">
                    <h1>Iglesia Evangelica Monte Calvario - Oruro.</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <img src="https://th.bing.com/th/id/R.e66cd375151524fd937db76ed6cf55b8?rik=4LGKf%2bcM22lPnw&pid=ImgRaw&r=0" alt="" height="500" width="1500">
            <div class="container">
                <div class="carousel-caption text-right">
                    <h1>Iglesia Evangelica Monte Calvario - Oruro</h1>
                    <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                    <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
                </div>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


<div class="container marketing mt-1">

    <!-- START THE FEATURETTES -->
    @foreach ($activities as $row)
    <hr class="featurette-divider">
    @if($row->id % 2 == 0)
    <div class="row featurette">
        <div class="col-md-7">
            <h2 class="featurette-heading text-center">{{$row->title}}</h2> <span class="text-muted">{{$row->created_at}}</span>
            <p class="lead">{{$row->description}}</p>
        </div>
        <div class="col-md-5">
            <img class="rounded-circle" src="{{ asset ('/storage/actividades/'.$row->image)}}" alt="" height="200">

        </div>
    </div>
    @else
    <div class="row featurette">
        <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading text-center">{{$row->title}}</h2>
            <span class="text-muted">{{$row->created_at}}</span>
            <p class="lead">{{$row->description}}</p>
        </div>
        <div class="col-md-5 order-md-1">
            <img class="rounded-circle" src="{{ asset ('/storage/actividades/'.$row->image)}}" alt="" height="200">

        </div>
    </div>
    @endif
    @endforeach
    <hr class="featurette-divider">

</div><!-- /.container -->
@endsection

<!-- CSS -->
@section('css')
<link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/carousel/">
@endsection
<!-- JS -->
@section('js')
@endsection