@extends('adminlte::page')

@section('title', 'Dashboard')

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
    <div class="card">
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
    <!--<p>Asistencia Hombres</p>
                <p>Asistencia Mujeres</p>
                <p>Falta Hombres</p>
                <p>Falta Mujeres</p>
                <p>Total Asistencia</p>-->
    <div>
        <table class="table-bordered" style="width:30%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Hombre</th>
                    <th>Mujer</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">Asistencia</th>
                    <td>100</td>
                    <td>150</td>
                </tr>
                <tr>
                    <th scope="row">Falta</th>
                    <td>50</td>
                    <td>60</td>
                </tr>
                <tr>
                    <th scope="row">Total</th>
                    <td colspan="2">300</td>
                </tr>
            </tbody>
        </table>
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
        /*  When user click add user button */
        function selectActivities() {
            //alert(activityId.value);
            mytable(activityId.value);
            //
            $.ajax({
                url: "{{ route('admin.asistencias.store') }}",
                type: 'POST',
                data: {
                    '_token': $('meta[name="csrf-token"]').attr('content'),
                    'activity_id': activityId.value
                },
                success: function(data) {
                    //alert('todo bien');
                },
                error: function(errorThrown) {
                    alert("jefe espere")
                }
            });
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

        function mytable(activity_id) {
            var table = $('#tblAssistance').DataTable({
                processing: true,
                //serverSide: true,
                responsive: true,
                autoWidth: false,
                paging: false,
                ordering: false,
                searching: false,
                showing: false,
                destroy: true,
                "bInfo": false,

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
                    },
                    error: function(data) {
                        alert('Error:', data);
                    }
                });
            }
        }
    </script>
@stop
