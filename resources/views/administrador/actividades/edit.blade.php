@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Crear</h1>
@stop

@section('content')
<div class="card">

    <div class="card-body">

        <form class="form-horizontal" action="{{ route('admin.actividades.update', $actividad->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row bg-light text-dark">

                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input class="form-control" value="{{$actividad->title}}" placeholder="Título" name="title" type="text" required>
                    </div>
                    @error('title')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <input class="form-control" value="{{$actividad->description}}" placeholder="Descripcion" name="description" type="text" required>
                    </div>
                    @error('description')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <label for="place">Lugar</label>
                        <input class="form-control" value="{{$actividad->place}}" placeholder="Lugar de actividad" name="place" type="text" required>
                    </div>
                    @error('place')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    
                    <div class="form-group">
                        <label for="date">Fecha de Actividad</label>
                        <input class="form-control" value="{{$actividad->date}}" placeholder="Fecha de actividad" name="date" type="text" required>
                    </div>
                    @error('date')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                   
                    <div class="form-group">
                        <label for="imagen">Nombre Imagen</label>
                        <input class="form-control" value="{{$actividad->image}}" placeholder="Nombre de la imagen" name="image" id="imagen" required>
                    </div>
                    @error('imagen')
                    <span class="text-danger">{{$message}}</span>
                    @enderror

                </div>
                <div class="col-md-6 mt-2">
                    <div class="card bg-light text-dark">


                        <div class="card-header bg-light text-dark">
                            Ajustar imagen
                        </div>
                        <div class="card-body">
                            <input type="file" name="before_crop_image" id="before_crop_image" accept="image/*" />
                            <img id="idimag" class="profile-user-img img-fluid" src="https://images.unsplash.com/photo-1542261777448-23d2a287091c?ixlib=rb-1.2.1&ixid=MXwxMjA3fDB8MHxleHBsb3JlLWZlZWR8MTR8fHxlbnwwfHx8&auto=format&fit=crop&w=500&q=60" alt="User profile picture">
                        </div>

                    </div>
                </div>
            </div>
            <div class="card bg-dark">
                <div class="container-fluid h-100 mt-2">
                    <div class="row w-100 align-items-center">
                        <div class="form-group ">
                            <div class="col text-center">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" required> Estoy seguro <a>de registrar</a>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="">
                                <button type="submit" class="btn btn-success ">Registrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>

    <!-- /.card-body -->
</div>
<!-- /.card -->
<!-- Fin contenido -->
<!-- Modal imagen -->
<div id="imageModel" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ajusta el imagen</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8 text-center">
                        <div id="image_demo" style="width:350px; margin-top:30px"></div>
                    </div>
                    <div class="col-md-4" style="padding-top:30px;">
                        <br />
                        <br />
                        <br />
                        <button class="btn btn-success crop_image">Guardar Foto</button>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script> </script>
@stop