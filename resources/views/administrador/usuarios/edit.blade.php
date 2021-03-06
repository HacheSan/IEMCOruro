@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Crear</h1>
@stop

@section('content')
<div class="card">

    <div class="card-body">

        <form class="form-horizontal" action="{{ route('admin.usuarios.update', $usuario->id)}}" method="POST">
            @csrf
            @method('PUT')
            <div class="row bg-light text-dark">

                <div class="col-md-6 mt-2">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input class="form-control" value="{{$usuario->name}}" placeholder="Nombre" name="name" type="text" required>
                    </div>
                    @error('name')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <label for="surname">Apellidos</label>
                        <input class="form-control" value="{{$usuario->surname}}" placeholder="Apellido Paterno Materno" name="surname" type="text" required>
                    </div>
                    @error('surname')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <label for="gender">Género</label>
                        <select class="form-control" name="gender">
                            <option value="1">Hombre</option>
                            <option value="2">Mujer</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="marital_status">Estado Civil</label>
                        <select class="form-control" name="marital_status">
                            <option value="1">Casado</option>
                            <option value="2">Soltero</option>
                            <option value="3">Viudo/a</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="address">Dirección</label>
                        <input class="form-control" value="{{$usuario->address}}" placeholder="Dirección" name="address" type="text" required>
                    </div>
                    @error('address')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <label for="status">Estado</label>
                        <select class="form-control" name="status">
                            <option value="1">Bautizado</option>
                            <option value="2">Entregado</option>
                            <option value="3">Niño Dedicado</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="imagen">Nombre Imagen</label>
                        <input class="form-control" value="{{$usuario->image}}" placeholder="Nombre de la imagen" name="image" id="imagen" required>
                    </div>
                    @error('imagen')
                    <span class="text-danger">{{$message}}</span>
                    @enderror
                    <div class="form-group">
                        <label for="role">Rol</label>
                        <select class="form-control" name="role">
                            <option value="1">ADMINISTRADOR</option>
                            <option value="2">SECRETARIO</option>
                            <option value="3">TESORERO</option>
                        </select>
                    </div>
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