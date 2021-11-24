@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Gestión de Recursos Económicos</h1>
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
    <section>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <button class="btn btn-info btn-sm" onclick="addTypeEconomy()"><i class="fa fa-plus"></i></button>
                    <div class="btn-group btn-group-sm ml-2" role="group" aria-label="Basic example">
                        @foreach ($boxtypes as $data)
                            <a href="javascript:void(0)" onclick="btnTypes({{ $data->id }})"
                                id="btnType{{ $data->id }}"
                                class="btn btn-outline-primary {{ $loop->first ? 'active' : '' }}">
                                {{ $data->type }}
                            </a>

                        @endforeach
                    </div>
                    {{-- <select class="custom-select" id="type_id" required>

                        @foreach ($boxtypes as $row)
                            <option value="{{ $row->id }}" {{ $loop->first ? 'selected' : '' }}>{{ $row->type }}</option>
                        @endforeach
                    </select> --}}

                </div>

            </div>
        </div>
    </section>

    <section>
        <div class="card">
            <div class="card-header">
                <div class="form-row">
                    <div class="col-md-3 mb-3">
                        <button class="btn btn-success btn-sm" onclick="addEconomy()"><i class="fa fa-plus"></i> Crear
                            economía</button>
                    </div>
                    <div>
                        <h3><span id="date"></span></h3>
                    </div>
                    <div class="col-md-3 mb-3">
                        <select class="custom-select" name="member_id" id="bymounth" required>
                            <option selected disabled value="">Filtro por mes</option>
                            <option value="1">Enero</option>
                            <option value="2">Febrero</option>
                            <option value="3">Marzo</option>
                            <option value="4">Abril</option>
                            <option value="5">Mayo</option>
                            <option value="6">Junio</option>
                            <option value="7">Julio</option>
                            <option value="8">Agosto</option>
                            <option value="9">Septiembre</option>
                            <option value="10">Octubre</option>
                            <option value="11">Noviembre</option>
                            <option value="12">Diciembre</option>

                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <select class="custom-select" name="member_id" id="byyear" required>
                            <option selected disabled value="">Filtro por año</option>
                            <option value="2015">2015</option>
                            <option value="2016">2016</option>
                            <option value="2017">2017</option>
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>
                    {{-- <div class="col-md-3 mb-3">
                        <button class="btn btn-outline-dark btn-sm" onclick="selectAll()">Todo</button>
                    </div> --}}
                </div>
            </div>
            <div class="card-body">
                <table id="tblEconomy" class="display nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nombres</th>
                            <th>Apellidos</th>
                            <th>Descripción</th>
                            <th>Fecha</th>
                            <th>Ingresos</th>
                            <th>Egresos</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                </table>
                <hr>
                <div>
                    <h5>Total Ingreso: <span class="text-secondary" id="totalIncome">0</span></h5>
                    <h5>Total Salida: <span class="text-secondary" id="totalEgress">0</span></h5>
                    <h5>Saldo Actual: <span class="text-primary" id="totalActual">0</span></h5>
                </div>
            </div>
        </div>

        </div>
    </section>
    <!-- Modal New Box Type -->
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nueva Caja</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.cajas.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="caja">Nombre Caja</label>
                                <input type="text" class="form-control" name="caja" id="caja" required
                                    placeholder="Escriba una caja">
                                <div class="invalid-feedback">
                                    El campo es obligatorio.
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">
                                    Acepto los términos y condiciones
                                </label>
                                <div class="invalid-feedback">
                                    Debe aceptar antes de enviar.
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Agregar caja</button>
                    </form>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> --}}
                    {{-- <button type="button" class="btn btn-primary">Agregar</button> --}}
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Economy -->
    <div class="modal fade" id="modalEconomy" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Nuevo Registro Económico</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="type_id" id="typeId" value="1" hidden>
                    <form id="formEconomy" class="needs-validation" novalidate>
                        @csrf

                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="member">Nombre</label>
                                <select class="custom-select" name="member_id" id="memberId" required>
                                    <option selected disabled value="">Seleccione un Miembro...</option>
                                    @foreach ($members as $row)
                                        <option value="{{ $row->id }}">{{ $row->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback">
                                    Debe seleccionar un miembro.
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col-md-12 mb-3">
                                <label for="description">Descripción</label>
                                <input type="text" class="form-control" name="description" id="description" required
                                    placeholder="Escriba una descripcion">
                                <div class="invalid-feedback">
                                    El campo descripción es obligatorio.
                                </div>
                            </div>
                        </div>
                        <label for="Rol" class="col-sm-12 col-form-label">Tipo de registro económico</label>
                        <div class="form-group row d-flex justify-content-center">

                            <div class="form-check col-sm-3">
                                <input class="form-check-input" checked="checked" type="radio" name="role" value="1">
                                <label class="form-check-label">Ingreso</label>
                            </div>
                            <div class="form-check col-sm-3">
                                <input class="form-check-input" type="radio" name="role" value="2">
                                <label class="form-check-label">Egreso</label>
                            </div>
                        </div>
                        <input type="text" value="1" name="type_in" id="typeIn" hidden>
                        <div class="form-row" id="ingresoId">
                            <div class="col-md-12 mb-3">
                                <label for="income">Ingreso</label>
                                <input type="number" min="0" class="form-control" name="income" id="income" value="0"
                                    required placeholder="Escriba una ingreso">
                                <div class="invalid-feedback">
                                    El campo es obligatorio.
                                </div>
                            </div>
                        </div>
                        <div class="form-row" id="egresoId" style="display:none;">
                            <div class="col-md-12 mb-3">
                                <label for="egress">Egreso</label>
                                <input type="number" min="0" class="form-control" name="egress" id="egress" value="0"
                                    required placeholder="Escriba una egreso">
                                <div class="invalid-feedback">
                                    El campo es obligatorio.
                                </div>
                                <div id="validateEgress" style="display:none;">
                                    <span class="text-danger">
                                        El egreso no debe exeder el total de la Caja.
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                <label class="form-check-label" for="invalidCheck">
                                    Acepto los términos y condiciones
                                </label>
                                <div class="invalid-feedback">
                                    Debe aceptar antes de enviar.
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block" id="btnRegisterEconomy" type="submit">Registrar
                            economía</button>
                    </form>
                </div>
                <div class="modal-footer">
                    {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button> --}}
                    {{-- <button type="button" class="btn btn-primary">Agregar</button> --}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    {{-- <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jq-2.2.4/pdfmake-0.1.27/dt-1.10.15/b-1.4.0/b-colvis-1.4.0/b-html5-1.4.0/b-print-1.4.0/datatables.min.css" /> --}}
@stop

@section('js')
    <script src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    {{-- <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js'></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jq-2.2.4/pdfmake-0.1.27/dt-1.10.15/b-1.4.0/b-colvis-1.4.0/b-html5-1.4.0/b-print-1.4.0/datatables.min.js">
    </script> --}}
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdn.datatables.net/plug-ins/1.11.3/api/sum().js"></script>

    <script>
        function btnTypes(id) {

            mytable(id, bymounth.value, byyear.value);
            var tam = {{ count($boxtypes) }};
            for (var i = 1; i <= tam; i++) {
                $("#btnType" + i).removeClass("active");
            }
            $("#btnType" + id).addClass("active");
            $('#typeId').val(id);
        }
    </script>
    <script>
        //document.getElementById('msgError').style.visibility = 'hidden';
        var months = ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10',
            '11', '12'
        ];;
        var date = new Date();
        $("select#bymounth").val(months[date.getMonth()]);
        $("select#byyear").val(date.getFullYear());

        $("select#bymounth").change(function() {
            var month = bymounth.value
            let type_id = $('#typeId').val();
            mytable(type_id, month, byyear.value)
        });
        $("select#byyear").change(function() {
            var year = byyear.value
            let type_id = $('#typeId').val();
            mytable(type_id, bymounth.value, year)
        });
        /* function selectAll(){
            let type_id = $('#typeId').val();
            mytable(type_id, "", "")
        } */

        mytable(1, bymounth.value, byyear.value);


        function addTypeEconomy() {
            $('#myModal').modal('show');
        }

        function addEconomy() {
            $('#modalEconomy').modal('show');
            $('input:radio[name=role]').change(function() {
                if (this.value == '1') {
                    var ingreso = document.getElementById('ingresoId');
                    ingreso.style.display = 'block';
                    var egreso = document.getElementById('egresoId');
                    egreso.style.display = 'none';
                    $('#egress').removeAttr('required');
                    $('#typeIn').val(1);
                } else if (this.value == '2') {
                    var egreso = document.getElementById('egresoId');
                    egreso.style.display = 'block';
                    var ingreso = document.getElementById('ingresoId');
                    ingreso.style.display = 'none';
                    $('#income').removeAttr('required');
                    $('#typeIn').val(2);
                }

            });

        }
        $('#btnRegisterEconomy').on('click', function(e) {
            //alert('hola');
            for (const el of document.getElementById('formEconomy').querySelectorAll("[required]")) {
                if (!el.reportValidity()) {
                    return;
                }
            }

            let type_id = $('#typeId').val();
            let member_id = memberId.value;
            let description = $('#description').val();
            let type_in = $('#typeIn').val();
            let income = $('#income').val();
            let egress = $('#egress').val();
            e.preventDefault();
            var form = $('#formEconomy');
            $.ajax({
                url: "{{ route('admin.economia.store') }}",
                type: 'POST',
                data: {
                    //data: form.serialize(),
                    member_id: member_id,
                    type_id: type_id,
                    description: description,
                    type_in: type_in,
                    income,
                    egress
                },
                success: function(data) {
                    //$('#formEconomy')[0].reset();

                    $('#modalEconomy').modal('hide');
                    var json = $.parseJSON(data); // create an object with the key of the array
                    //alert(json.type_id);
                    if (json.type_id == '0') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error....',
                            text: json.msg,
                        });

                        /* setTimeout(function() {
                            //document.getElementById('msgError').style.visibility = 'hidden';
                        }, 5000); */

                    } else {
                        if (json.egress == '0') {
                            Swal.fire({
                                icon: 'success',
                                title: 'OK',
                                text: 'Ingreso registrado satisfactoriamente!',
                            })
                            /* .then(() => {
                                                            location.reload();
                                                        }); */
                        } else {
                            Swal.fire({
                                icon: 'success',
                                title: 'OK',
                                text: 'Salida registrado satisfactoriamente!',
                            })
                        }
                        mytable(json.type_id, bymounth.value, byyear.value);
                    }

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert('Algo salió mal a registrar economia.');
                }
            })
        });
        //charge data table

        function mytable(type_id, month ,year) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('#tblEconomy').DataTable({
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
                /* buttons: [
                    //'print',
                    {
                        extend: 'print',
                        className: 'btn btn-primary',
                        text: '<i class="fa fa-print"></i> Imprimir',

                        exportOptions: {
                            columns: ':visible'
                        },
                        customize: function(window) {
                            $(window.document.body).children().eq(0).after($('#statistic').html());
                            $(window.document.body)
                                .prepend('<img style="position:absolute; top:6; right:10;width:70" src=' +
                                    $logo + '>')
                            $(window.document.body).find('table')
                                //.removeClass('dataTable')
                                //.css('font-size', '12px')
                                .css('margin-top', '65px')
                            //.css('margin-bottom', '60px')
                        }
                    },

                    {
                        extend: 'colvis',
                        className: 'btn btn-primary',
                        text: '<i class="fa fa-eye"></i> Columna Visible',

                        exportOptions: {
                            columns: ':visible'
                        },
                    },

                ], */
                columnDefs: [{
                    visible: false
                }],
                "ajax": {
                    "url": "{{ route('admin.tbleconomy') }}",
                    type: 'POST',
                    data: {
                        type_id: type_id,
                        month: month,
                        year: year,
                    },
                    cache: false,

                },
                columns: [{
                        data: 'id',
                        name: 'id'
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
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'date',
                        name: 'date'
                    }, {
                        data: 'income',
                        name: 'income'
                    }, {
                        data: 'egress',
                        name: 'egress'
                    }, {
                        data: 'total',
                        name: 'total'
                    },
                    /* {
                        data: 'delete',
                        name: 'delete',
                        orderable: false,
                        className: 'text-center'
                    }, */
                ],
                /*  order: [
                     [0, 'desc']
                 ], */
                drawCallback: function() {
                    var income = $('#tblEconomy').DataTable().column(5).data().sum();
                    var egress = $('#tblEconomy').DataTable().column(6).data().sum();

                    $('#totalIncome').html(income);
                    $('#totalEgress').html(egress);
                    $('#totalActual').html(income - egress);
                },
            });

        }
    </script>
    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
@stop
