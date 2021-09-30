@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
<h1>Registrar Asistencia</h1>

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
<select class="custom-select mb-3 col-sm-3">
    <option selected>Buscar la actividad </option>
    <option value="1">Actividad 1</option>
    <option value="2">Actividad 2</option>
    <option value="3">Actividad 3</option>
</select>

<form class="form-inline mt-2 mt-md-0">
    <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
</form>

<div class="row" style="padding: 3px 15px;">
    <!--<a href="{{route('admin.miembros.create')}}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nuevo Miembro</a>-->
    <!-- <a href="/importfile" class="pull-right btn btn-success"><i class="fas fa-file-import"></i> Import</a> -->
</div>
<table id="tablAsistencia" class="display nowrap" style="width:100%">
    <thead>
        <tr>
            <th>No</th>
            <th>CI</th>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Género</th>
            <th>Opciones</th>
        </tr>
    </thead>
</table>
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
        processing: true
        , autoWidth: false
        , paging: false
        , ordering: false
        , searching: false
        , showing: false,

        , responsive: true
        , "language": {
            "lengthMenu": "Mostrar " +
                '<select class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">All</option></select>' +
                " registros por página"
            , "zeroRecords": "No existe registros - discupa"
            , "info": "Mostrando la pagina _PAGE_ de _PAGES_"
            , "infoEmpty": "No records available"
            , "infoFiltered": "(filtrado de _MAX_ registros totales)"
            , "search": "Buscar:"
            , "paginate": {
                "next": "Siguiente"
                , "previous": "Anterior"
            }
        }
    , });

    $(document).ready(function() {
        $('#tablAsistencia').DataTable();
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

</script>
@stop
