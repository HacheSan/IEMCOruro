@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Registro de Recojo de Certificados</h1>
    <!-- msg success -->
    @if (session('info'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Hey!</strong> {{ session('info') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
@stop

@section('content')
    <div class="row" style="padding: 3px 15px;">
        <button class="btn btn-primary btn-sm" id="newCertificate"><i class="fas fa-plus"></i> Nuevo Registro</button>
    </div><br>
    <table id="tablaCertif" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Acciones</th>
                <th>Miembro</th>
                <th>Descripción</th>

                <th>Fecha</th>
                <th>Entregado</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($certificates as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td>
                        <button onclick="updateCetificate('{{ $row->id }}')" class="btn btn-info btn-sm">
                            <i class="fas fa-edit"></i>
                        </button>
                        <a onclick="return confirm('¿Seguro quiere eliminar?')"
                            href="{{ route('admin.deletecertconfirm', $row->id) }}" class="btn btn-danger btn-sm">
                            <i class="fa fa-trash-alt"></i>
                        </a>
                    </td>

                    <td>{{ $row->name }} {{ $row->surname }}</td>
                    <td>{{ $row->description }}</td>
                    <td>{{ $row->date }}</td>
                    <td>{{ $row->status }}</td>
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

                        <form action="{{ route('admin.certificados.store') }}" method="POST">
                            @csrf
                            <div class="input-group mb-3 col-sm-12">

                                <input type="text" name="text" id="search" class="form-control form-control-sm"
                                    placeholder="Escriba CI (Ej. 1234567)">
                                <div class="input-group-append">
                                    <a class="btn btn-dark btn-sm" onclick="searchMemberByCi()" id="button-addon2">
                                        <i class="fa fa-search"></i> Buscar
                                    </a>
                                </div>
                            </div>
                            <div class="alert alert-success" role="alert" id="findMember" style="display: none">
                                <li>Nombres: <b id="nameMember"></b></li>
                                <li>CI: <b id="ciMember"></b></li>
                            </div>
                            <input type="text" id="member_id" name="member_id" hidden>
                            <div class="form-group">
                                <label>Descripción</label>
                                <textarea class="form-control" rows="3" placeholder="Descripcion de recojo de certificado"
                                    name="description" required></textarea>
                            </div>
                            <button class="btn btn-sm btn-primary" type="submit">Aceptar</button>
                        </form>
                    </div>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        table.dataTable thead tr {
            background-color: rgb(49, 58, 55);
            color: #fff;
        }
    </style>
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
                "lengthMenu": "Mostrar registro por página " +
                    '<select class="custom-select custom-select-sm form-control form-control-sm"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option><option value="-1">Todo</option></select>',
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
            $('#tablaCertif').DataTable();
        });
    </script>
    <script>
        /*  When user click add user button */
        $('#newCertificate').click(function() {
            $('#title').html("Nuevo Certificado");
            $('#my-modal').modal('show');
        });

        function searchMemberByCi() {
            var ci = $('#search').val();
            $.ajax({
                url: "{{ route('admin.searchmember') }}",
                type: 'POST',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'ci': ci,
                },
                success: function(data) {
                    var json = $.parseJSON(data);
                    if (json.id == "0") {
                        alert(ci + " No se encuentra registrado");
                    } else {

                        document.getElementById('findMember').style.display = '';
                        $('#member_id').val(json.id);
                        $('#nameMember').html(json.name+' '+json.surname);
                        $('#ciMember').html(json.ci);
                    }
                }
            });
        }
        //Actualizar estado
        function updateCetificate(id) {
            if (confirm("Desea entregar el certificado !")) {
                $.ajax({
                    type: "post",
                    url: "{{ route('admin.certificados.updatecertificate') }}",
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'id': id,
                    },
                    success: function(data) {
                        url = "{{ route('admin.certificados.index') }}";
                        location.reload(url);
                    }
                });
            };
        }
    </script>
@stop
