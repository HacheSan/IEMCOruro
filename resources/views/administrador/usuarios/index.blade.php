@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Usuarios del sistema</h1>
<!-- msg success -->
@if(session('info'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Hey!</strong> {{session('info')}}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@stop

@section('content')
<div class="row" style="padding: 3px 15px;">
    <a href="javascript:void(0)" class="btn btn-primary btn-sm" id="create_new"><i class="fas fa-plus"></i> Asignar Rol</a>
    <!-- <a href="/importfile" class="pull-right btn btn-success"><i class="fas fa-file-import"></i> Import</a> -->
</div><br>
<table id="tablausuario" class="display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Rol</th>
            <th>Gégero</th>
            <th>Estado Civil</th>
            <th>Dirección</th>
            <th>Estado</th>
            <th>Teléfono</th>
            <th>E-mail</th>
            <th>Foto</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $row)
        <tr>
            <td>{{$row->id}}</td>
            <td>{{$row->name}}</td>
            <td>{{$row->surname}}</td>
            <td>
                @switch($row->role)
                @case(1)
                <span class="badge bg-success">ADMINISTRADOR</span>
                @break

                @case(2)
                <span class="badge bg-warning">SECRETARIO</span>
                @break

                @default
                <span class="badge bg-info">TESORERO</span>
                @endswitch
            </td>
            <td>{{$row->gender}}</td>
            <td>{{$row->marital_status}}</td>
            <td>{{$row->address}}</td>
            <td>{{$row->status}}</td>
            <td>{{$row->phone}}</td>
            <td>{{$row->email}}</td>
            <td>{{$row->image}}</td>
        </tr>
        @endforeach
    </tbody>
</table>


<!-- Modal -->
<div class="modal fade" id="my-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>

                <div class="card-body">

                    <form action="" method="get">
                        <div class="input-group mb-3 col-sm-12">

                            <input type="text" name="text" id="search" class="form-control form-control-sm" placeholder="Escriba para buscar (ej. Juan)" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-dark btn-sm" type="submit" id="button-addon2"> <i class="fa fa-search"></i> Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>
                <table id="TbMiembro" class="table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nombre</th>
                            <th>Apellidos</th>
                            <th>Genero</th>
                            <th>Estado Civil</th>
                            <th>Dirección</th>
                            <th>Edad</th>
                        </tr>
                    </thead>
                    <tbody>


                        <tr>
                            <td>1</td>
                            <td>Carlos</td>
                            <td>Perez</td>
                            <td>Hombre</td>
                            <td>Casado</td>
                            <td>Urb: San Fra</td>
                            <td>34</td>
                        </tr>

                    </tbody>
                </table>
                <form id="userForm" name="userForm" class="form-horizontal" enctype="multipart/form-data">

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12 d-flex justify-content-center">
                                <h4 class="text-center">Carlos Perez </h4>.
                            </div>
                        </div>

                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Contraseña</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Confirmar contaseña</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirmar Contraseña" required>
                            <span id='message'></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Rol" class="col-sm-2 col-form-label">Rol</label>
                        <div class="form-check col-sm-3">
                            <input class="form-check-input" type="radio" name="rol" value="1">
                            <label class="form-check-label">Admin</label>
                        </div>
                        <div class="form-check col-sm-3">
                            <input class="form-check-input" type="radio" name="rol" value="2">
                            <label class="form-check-label">Secretario</label>
                        </div>
                        <div class="form-check col-sm-3">
                            <input class="form-check-input" type="radio" name="rol" checked="" value="3">
                            <label class="form-check-label">Tesorero</label>
                        </div>
                    </div>

                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary btn-submit" id="btn-save" value="create">Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
@stop

@section('js')
<!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
<script src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script>
    $.extend($.fn.dataTable.defaults, {
        processing: true,
        responsive: true,
        "language": {
            "lengthMenu": "Mostrar " +
                 '<select class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">All</option></select>' +
                " registros por página",
            "zeroRecords": "No existe registros - discupa",
            "info": "Mostrando la pagina _PAGE_ de _PAGES_",
            "infoEmpty": "No records available",
            "infoFiltered": "(filtrado de _MAX_ registros totales)",
            "search": "Buscar:",
            "paginate": {
                "next": "Siguiente",
                "previous": "Anterior"
            }
        },
    });

    $(document).ready(function() {
        $('#tablausuario').DataTable();
    });
</script>
<script>
    /*  When user click add user button */
    $('#create_new').click(function() {
        $('#btn-save').val("create-user");
        $('#user_id').val('');
        $('#userForm').trigger("reset");
        $('#title').html("Nuevo Usario");
        $('#my-modal').modal('show');
    });


    //validar password
    $('#password, #confirm_password').on('keyup', function() {
        if ($('#password').val() == '') {
            $('#message').html('Sin datos').css('color', 'white');
            $('#confirm_password').css("border-color", "red");
        } else if ($('#confirm_password').val() == $('input[name="password"]').val() && $('#confirm_password').val().length > 5) {
            //$('#confirm_password').css( 'border-color','green');
            //$('#confirm_password').css("border-color", "green");
            //element.classList.remove("borderRed");
            var element = document.getElementById('confirm_password');
            // element.style.removeAttribute("border");
            element.style.border = "";
            var element = document.getElementById('confirm_password');
            element.style.border = "2px solid green";
            $('#message').html('Correcto').css('color', 'green');
        } else {
            $('#message').html('Las contraseñas no coinciden o es menor a 5 caracteres').css('color', 'red');
            $('#confirm_password').css("border-color", "red");
        }
    });
</script>
@stop