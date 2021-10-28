@extends('adminlte::page')

@section('title', 'IEMC-ORURO')

@section('content_header')
    <h1>Registrar Asistencia</h1>

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
    <select class="custom-select mb-3 col-sm-3" name="activity_id" id="activityId" onchange="selectActivities()">
        <option selected>Buscar la actividad </option>
        @foreach ($activities as $row)
            <option value="{{ $row->id }}">{{ $row->title }}</option>
        @endforeach
    </select>

    <form class="form-inline mt-2 mt-md-0">
        <input class="form-control mr-sm-2" id="ci" type="text" placeholder="Buscar por CI" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" id="btnAddAssistance" type="button">Buscar</button>
    </form>

    <div class="row" style="padding: 3px 15px;">
        <!--<a href="{{ route('admin.miembros.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nuevo Miembro</a>-->
        <!-- <a href="/importfile" class="pull-right btn btn-success"><i class="fas fa-file-import"></i> Import</a> -->
    </div>
    <div class=" ">
        <table id="tblAssistance" class="display nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>CI</th>
                    <th>Nombre</th>
                    <th>Apellidos</th>
                    <th>Género</th>
                    <th>Opciones</th>
                </tr>
            </thead>
        </table>
    </div>

    <div class="d-flex justify-content-center" id="statistic">

        <div class="card-body col-md-6">
            <h4>REPORTE DE ASISTENCIA</h4>
            <table class="table-bordered" style="width:100%">
                <thead>
                    <tr>
                        <th>REPORTE</th>
                        <th>Hombre</th>
                        <th>Mujer</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Asistencia</th>
                        <td id="ath"></td>
                        <td id="atm"></td>
                    </tr>
                    <tr>
                        <th scope="row">Falta</th>
                        <td id="fath"></td>
                        <td id="fatm"></td>
                    </tr>
                    <tr>
                        <th scope="row">Total Asistencia Actividad</th>
                        <td colspan="2" id="taa"></td>
                    </tr>
                    <tr>
                        <th scope="row">Total Miembros</th>
                        <td colspan="2" id="trm"></td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
@stop

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jq-2.2.4/pdfmake-0.1.27/dt-1.10.15/b-1.4.0/b-colvis-1.4.0/b-html5-1.4.0/b-print-1.4.0/datatables.min.css" />
@stop

@section('js')
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js'></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jq-2.2.4/pdfmake-0.1.27/dt-1.10.15/b-1.4.0/b-colvis-1.4.0/b-html5-1.4.0/b-print-1.4.0/datatables.min.js">
    </script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script>

        function selectActivities() {
            // alert(activityId.value);
            mytable(activityId.value);
            reportAssistance(activityId.value);

        }
        //Create assistance
        $('#btnAddAssistance').click(function() {
            var activity_id = activityId.value;
            var ci = $('#ci').val();
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
                        $.ajax({
                            url: "{{ route('admin.asistencias.store') }}",
                            type: 'POST',
                            data: {
                                '_token': $('meta[name="csrf-token"]').attr('content'),
                                'activity_id': activity_id,
                                'member_id': json.id
                            },
                            success: function(data) {
                                //alert('todo bien');
                                mytable(activity_id);
                                reportAssistance(activity_id);
                            },
                            error: function(errorThrown) {
                                alert(ci + " ya se encuentra registrado")
                            }
                        });
                    }
                }
            });
        });
        // datatables
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //charge data report
        function reportAssistance(activityId) {
            $.ajax({
                url: "{{ route('admin.reportassistance') }}",
                type: 'POST',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'activity_id': activityId
                },
                success: function(data) {
                    var json = $.parseJSON(data);
                    //alert(json.ath);
                    $('#ath').html(json.ath);
                    $('#atm').html(json.atm);
                    $('#fath').html(json.fath);
                    $('#fatm').html(json.fatm);
                    $('#taa').html(json.taa);
                    $('#trm').html(json.trm);

                },
                error: function(errorThrown) {
                    alert("jefe espere")
                }
            });
        }
        //charge data table
        function mytable(activity_id) {
            var table = $('#tblAssistance').DataTable({
                processing: true,
                //serverSide: true,
                responsive: true,
                autoWidth: false,
                paging: true,
                ordering: true,
                searching: true,
                showing: true,
                destroy: true,
                "bInfo": true,
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
                dom: 'Bfrtip',
                buttons: [
                    //'print',
                    {
                        extend: 'print',
                        text: 'IMPRIMIR',
                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after($('#statistic').html());
                        }
                    },

                    'colvis'

                ],
                columnDefs: [{
                    visible: false
                }],
                "ajax": {
                    "url": "{{ route('admin.tblassistance') }}",
                    type: 'POST',
                    data: {
                        activity_id: activity_id,
                    },
                    cache: false,

                },
                columns: [{
                        data: 'ci',
                        name: 'ci'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'surname',
                        name: 'surname'
                    },
                    {
                        data: 'gender',
                        name: 'gender'
                    },
                    {
                        data: 'delete',
                        name: 'delete',
                        orderable: false
                    },
                ],
                /*  order: [
                     [0, 'desc']
                 ], */
            });

        }

        function deleteAssistance(activity_id, member_id) {
            if (confirm("¿Seguro desea eliminar la asistenia?")) {
                $.ajax({
                    url: "{{ route('admin.destroyassistance') }}",
                    type: 'POST',
                    data: {
                        '_token': $('meta[name="csrf-token"]').attr('content'),
                        'activity_id': activity_id,
                        'member_id': member_id,
                    },
                    success: function(data) {
                        mytable(activity_id);
                        reportAssistance(activity_id);
                    },
                    error: function(data) {
                        alert('Error:', data);
                    }
                });
            }
        }
    </script>
@stop
