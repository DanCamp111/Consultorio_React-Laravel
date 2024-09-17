@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1 class="display-4 text-center">Bienvenid@, Dr(a){{ $userName }}</h1>
@stop

@section('content')
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="d-flex align-items-center justify-content-center bg-primary text-white" style="height: 200px;">
                    <h3>Aviso 1: Este es el primer aviso importante</h3>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex align-items-center justify-content-center bg-secondary text-white" style="height: 200px;">
                    <h3>Aviso 2: Este es el segundo aviso importante</h3>
                </div>
            </div>
            <div class="carousel-item">
                <div class="d-flex align-items-center justify-content-center bg-success text-white" style="height: 200px;">
                    <h3>Aviso 3: Este es el tercer aviso importante</h3>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <style>
        .display-4 {
            font-size: 5rem; /* Ajusta el tamaño aquí */
            font-weight: 300;
        }
        .carousel-item {
            height: 200px;
        }
        .carousel-item h3 {
            text-align: center;
        }
    </style>
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop

