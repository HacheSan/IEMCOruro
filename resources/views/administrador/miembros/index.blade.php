@extends('adminlte::page')

@section('title', 'IEMC-ORURO')

@section('content_header')
    <h1 id="mitext">Miembros Registrados</h1>
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
        <a href="{{ route('admin.miembros.create') }}" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Nuevo
            Miembro</a><!-- id="create_new" -->
        {{-- <button class="ml-2 btn btn-danger btn-sm"><i class="fas fa-print"></i> Imprimir</button> --}}
        <!-- <a href="/importfile" class="pull-right btn btn-success"><i class="fas fa-file-import"></i> Import</a> -->
    </div><br>
    <table id="tablausuario" class="display nowrap" style="width:100%">
        <thead>
            <tr>
                <th>No</th>
                <th>Opciones</th>
                <th>Nombre</th>
                <th>Apellidos</th>
                <th>CI</th>
                <th>Estado</th>
                <th>Género</th>
                <th>Estado Civil</th>
                <th>Dirección</th>
                <th>Cargo</th>
                <th>Teléfono</th>
                <th>Edad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($members as $row)
                <tr>
                    <td>{{ $row->id }}</td>
                    <td><a href="{{ route('admin.miembros.edit', $row->id) }}" class="btn btn-info btn-xs"><i
                                class="fas fa-edit"></i></a>
                        <form action="{{ route('admin.miembros.destroy', $row->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger btn-xs"
                                onclick="return confirm('¿Seguro quiere eliminar?')"><i class="fas fa-trash"></i></button>
                        </form>

                    </td>

                    <td>{{ $row->name }}</td>
                    <td>{{ $row->surname }}</td>
                    <td>{{ $row->ci }}</td>
                    <td>
                        @switch($row->status)
                            @case(1)
                                Bautizado
                            @break

                            @case(2)
                                Entregado
                            @break

                            @default
                                Niño Dedicado
                        @endswitch
                    </td>
                    <td>
                        {{ $row->gender }}
                    </td>
                    <td>
                        @switch($row->marital_status)
                            @case(1)
                                Casado/a
                            @break

                            @case(2)
                                Soltero/a
                            @break

                            @default
                                <span class="badge bg-info">Viudo/a</span>
                        @endswitch
                    </td>
                    <td>{{ $row->address }}</td>
                    <td>{{ $row->post }}</td>
                    <td>{{ $row->phone }}</td>
                    <td>{{ (int) $now - (int) $row->date_of_birth }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>




@stop

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="//cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.0.1/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/v/dt/jq-2.2.4/pdfmake-0.1.27/dt-1.10.15/b-1.4.0/b-colvis-1.4.0/b-html5-1.4.0/b-print-1.4.0/datatables.min.css" />

    <style>
        .dataTables_wrapper .dt-buttons {
            float: none;
            text-align: center;
        }

    </style>
@stop

@section('js')
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script src="//cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>

    {{-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script> --}}
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.print.min.js"></script>
    <script src='https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js'></script>
    <script type="text/javascript"
        src="https://cdn.datatables.net/v/dt/jq-2.2.4/pdfmake-0.1.27/dt-1.10.15/b-1.4.0/b-colvis-1.4.0/b-html5-1.4.0/b-print-1.4.0/datatables.min.js">
    </script>
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
            dom: 'Bfrtip',
            buttons: [
                //'print',
                {
                    extend: 'print',
                    text: 'IMPRIMIR',
                    exportOptions: {
                        columns: ':visible'
                    },
                    /*customize: function(window) {
                        $(window.document.body).children().eq(0).after($('#mitext').html());
                    }*/
                    customize: function(doc) {
                        $(doc.document.body)
                            .prepend('<img style="position:absolute; top:6; right:10;width:70" src=' +
                                $logo + '>')
                        $(doc.document.body).find('table')
                            //.removeClass('dataTable')
                            //.css('font-size', '12px')
                            .css('margin-top', '65px')
                            //.css('margin-bottom', '60px')
                    },

                },
                /* {
                    extend: 'print',
                    //footer: true,
                    text: '<i class="fas fa-print"> Imprimir',
                    title: 'Lista de miembros IEMC-ORURO',
                    titleAttr: 'Imprimir',
                    className: 'btn btn-sm btn-dark',
                    exportOptions: {
                        columns: [0, 2, 3, 4, 5, 6, 7, 8, 10]
                    }
                }, */
                /* {

                    extend: 'pdfHtml5',
                    text: 'PDF',
                    orientation: 'portrait',
                    pageSize: 'LETTER',
                    title: 'Reporte de Citas Procesadas',
                    exportOptions: {
                        columns: ':visible',
                        modifier: {
                            page: 'current'
                        }
                    },
                    customize: function(doc) {
                        doc.content.splice(1, 0, {
                            columns: [{
                                    margin: 12,
                                    alignment: 'left',
                                    image: 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAGQAAABkCAIAAAD/gAIDAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA9lpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wUmlnaHRzPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvcmlnaHRzLyIgeG1sbnM6eG1wTU09Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9tbS8iIHhtbG5zOnN0UmVmPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvc1R5cGUvUmVzb3VyY2VSZWYjIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtcFJpZ2h0czpNYXJrZWQ9IkZhbHNlIiB4bXBNTTpPcmlnaW5hbERvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDoxN2FlYzk4Yy0zMjgzLTExZGEtYTIzOC1lM2UyZmFmNmU5NjkiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6QUYzODU5RTYxNDNCMTFFNTlBNjVCOTY4NjAwQzY5QkQiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6QUYzODU5RTUxNDNCMTFFNTlBNjVCOTY4NjAwQzY5QkQiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDowODgwMTE3NDA3MjA2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',
                                    width: 50,
                                    height: 50
                                },
                                {
                                    margin: [30, 25],
                                    alignment: 'left',
                                    fontSize: 15,
                                    text: 'Esto puede contener informacion del usuario'
                                }
                            ]
                        });
                    }


                }, */

                'colvis'

            ],
            columnDefs: [{
                visible: false
            }]
        });
        $logo =
            'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAoGCBEVExcTExUYGBcXGBcZGRoaGxkZGhcZGRkfGRoZGRsaICsjGh8oHSAXJDUkKC0uMzIyGSM3PDcxOysxMi4BCwsLDw4PHRERHTEpISgxMjExMTM1LjExMTMzMjExMTExMTExMTExMTExMTExMTExMTExMTExMTExMTExMTExMf/AABEIAOEA4QMBIgACEQEDEQH/xAAcAAEAAQUBAQAAAAAAAAAAAAAABgMEBQcIAQL/xABQEAACAQMBAwUKCQoEBAYDAAABAgMABBESBSExBgcTQVEUIjJTYXGBkaHRFSNCUnJzk7GzMzQ1YnSCkqKywRYkJYRDRIPxVMLS0+HwF1Vj/8QAGgEBAAMBAQEAAAAAAAAAAAAAAAEDBAIFBv/EADERAAIBAgQEBQMDBQEAAAAAAAABAgMRBBIhMRQzQVEFExUycSI0sVJhwSRCgZGhI//aAAwDAQACEQMRAD8A3NSlKAiXOHdSRpGY3KEsQcde6oX8MXXjm9nuqX85v5OP6R+6oEK8vF1JRnZM+Y8TqSVdpPsX3wzdeOb2e6nwzdeOf2VY1nLe1Rre1JA1S3iRs3ytDByRnj1CqqXmVHZSM2HhVrSyxl/0sfhm68c3s91Phm68a/s91X22r22/zELJFG8U8ccGnw5FJUSAjzFvZVDb0SLfvGqgIrQAKAAMMFLbvLk1dUpVYq+Y1VMJVgr5uxQ+Grrxz+z3U+Gbrxzez3Ve8prgLPLbpbRRxq0a9Lgh9LIkjsu7TkamHHqqpypuI4jPA1sqKI1NrIgJd305Jc8Aurd/3o6VTX6tjp4Kor/Xt8mO+Gbrxzez3U+GLvxzez3VmZbOL4T6PSvRJbrKy4GDukySPPpPorFcq4UjuWWMaY3jikUAAABgy7seVSa5nTqxjmzFdXDVoQcnLRMp/DN145vZ7q9+Gbrxzez3VktsziFLdYrSKTpINbu4PenvRxAPaTv7K+IrJWbZver8YjLJgDDvHoLE9uQHqXSqbKR1wdXZT13tqY74ZuvHN7PdXvwzdeOb2e6s9yVt4JDO0kaYe6mhi70YVYw5GB1ZCE+c1bcntmJJYTBgvTBpY42IGrpI0yAPSpqfJq/qOuBr3Szd+/QxXwzdeNf2e6nwzdeOb2e6s1Hawi41dGpSPZ0c4TGFZy0m9u3cBVPYM1tc3NsCkfSPBI08aDKI66NG48Mhm9VdcPV/UTwFbrL8mJ+Gbrxr+z3U+GLrxz+z3VkOT8/dF1GslrFEnxpIVTl92FzqA4cfTVtyIiSW5CuoYESbiBjvWwN1VOnUTX1dbFUsNUi0lK93bqUPhm68c3s91Phm68a/s91ZHZ0sMVvZNJHGy3GszSScUVV3FezeQKrciYLd+leQB0Moij1DPF2CkZ7QVrt0aiklmLHgq2ZRzbmI+GLrxz+z3U+GLrxz+z3VZTRlXkQ/IkkT+Byv9q8FZZVJptXZ51SVSEnFt6Ek5CX80l+qySMwFtMcE7s9LEM4G7OM+utkitXc3P6RH7LN+LFW0q9bDNummz6nANuhFs9pSlXmwUpSgFKUoCG8535OP6R+6oCKn3Od+Tj+kfuqAivIxnMPlfFPuH8I9qQWbAW1iT/+xj9HeyVH68kBbALMVByE1NozvGdGdOcE78ddV0aqpyuynB140ZuT7Es2qJUhvukUor3URiJGNeuSMHSflA4Htq35S7Pn+EHm6NujLQd/8ncFB9u6sJZWU9xIqCR3KZZVeRyq6esZJwd/Grq12VeTSSRrNMxjbDq08ukEE8ATv3itrqqpHRM9d4iFaGkXZ/kyHK+K/kuJFkZxaK8WjvE0AaEyxbGogSF87+qqm0raVLO6jnBZLVNcErDGo6dWhTk6hnvePk7Kxdjsa6uYg/dEhjk8BZLiTTJ14CsSGG72VRutlXDQGWSSRoYnIMbSOQrq+k94d25vVU5tW8r1JzrM5OL1RJdrRILi8kkfooxs+KMyYLFOlaVdQUbyRgbhWH5V6GWzljcyI1uU1lShfoiuCVbeucucGqf+HbqR3jMhLEIzq0zkMN7Rgg+EBgkDG6vv/Dly0hjMiExqW0mUlEBJUnSdynIOdwqKkpSi4qLJrVJVIOEYPX8mR5QrfvFbxwFxC1tiTQqEEkKMEsMjvc8MVdclEVraOYkf5R5n84aJv7OPVUV2nDcRP0b3MoyurSlxIUC5xjSGwOHCrmfYFwkJOtlQJqaJJXVimMEsinvhjdvrmM3nvZ6LUrjX/wDS+V6KzXYveTzQR2uzTPN0UjTPOq6GcyuwaMglR3g+NG89tXk8vcwYjcE2qCfoyx6m/lkNYBNkytD3VqJjiVgMu2UVSNXRrwXgOGOFUbuzlWNJZZJGSR2Khnd8uoIJZWOMgDAPZVnntL2ss4xpXyvYmW0kBvZ40GdWzFVFHX8ZKML6xVPZTyC42csg0ydy3JdMaSMGELleo4yN/lqLvs2dZ0TpG6WRFZG6RyQvfYCvxUeFuHbX3ZbIuJOmuEldmjLxvJ0j9J8X4Sow3448CKlVm/7WdrFtv2sy3JtL43sUl4XLaZVQMqJgEZIAUDPVxr55EbOmiuVMsbJkS41bs99n7t9Y/ZuxruZFmSeQjJVGe4lDAncQpJyCR2VQuLC5RZJZJpviGVGLTyllaTSBo748Qy9e/NcOV7Oz3uUuadpOL3utDK2GzmuLXZiKrFAJBIy/IGOJOCBvGK+7J7eO3iMkxiBv3ZMI0hlEDsgXvB3oYKDqqwl2DdxQtplZFC6niSVlcL85lHpz21h0jHeDLaUBCLqYqgPHSpOBnyVE68YPM4u4q4uFOSlKLTsZLlNHovLheoyBx5njVj/NqrHpRgSxZmZmPEszMd3AZYk48leivPqSUpNo8TEVFUqOS6mc5uP0iP2Wb8WKtpCtW83H6RH7LN+LFW0hXr4Xlo+o8P8At4ntKUrQbRSlKAUpSgIZzm/k4/pH7qgbVPecz8nH9I/dWuZ5cGvIxnN/wfL+JxbxLt2LmlWfdFO6Ky2PP8qRKeQzabnV2RucebBqT7BQR3E0mN11KjIf1e5hIxHaNWRUA2BtlLeQyurMOjdcLgnLYxuJG701kNm8s1jFmskcp7ngZXwE79zGiLoy+8bn44416eFnGMLNn0Hh84QpJSety52Qo6HYueouR5DpG/1Z9dZhHDQyWzYxdXd9DnsJWV1I9K1FthcoLVILVbhJjJZ5KdHoKvkY0tk7urs3gb+qqD8oyyQ5jZZEvJLpsY0BXMhCBs5LYYA7gOO+r1Vja7ZrVamle6JFfRj4Zi1AahHFjyHRJnFWWwreIjaqyMER+6hJIF1FVMswZiB4WBk+irK45TRSbQW8EcgjRVGkhNZKq43ANgjvh11b7J27AgvOmSYx3ZlGmMJrVZJJG36nABw/lqlVI5t+v8GdVY5/d1/gtWS3UstuQ0YAw+gx6t2/vSAd1SDlVJKt9IYAC72kaMdJfCEvncOHVv4b6jt9ewO3+XSVE0gHpdGrVnq0sd2MVmdpcqbciSZIpe65LfucA6ehXj8Zqznic9u4DA41XTteSbsUUVaU1mSbsZrZ4+Khsc5WSwuXI7Wd4+jPqMtYTab6tn2DdryH1q9VrflsyTx6A4tI41QxlIukcqrKWBLbhno8DUOBqyXbtg1vDBLDdnonlZNAiG52bSGy/UrD01dJwlFpPpY0zcJQyxkr2sSTZ41S2Nwc4jtbjWeodHoXf/E9UeQs7LBZRPxuzcySDt7wk+0isJFyqjSwlthFL0kiTpE+Ewiyk6dZ15B4E4B3iqlpywkjNtFDqWGGNVlBSMtKwxq6M6twxnsrqM4JK7OoVIRiryW2v4Mjs/Z8T2NvHNKkYivMAuM65I2dAgyQA2eB8lOULuYdpl10nuyzAGQTpVrdQd3zgA371YbaPKKKSNY44pVxePc5dUACsXYjcx77LdmPLXu3OUsc0d2iRyhriW2dSwQBRD0OrVhyd/RnGM8anzIJWudqrTistySXyju+/OBnuIDPXjSd1Qy2PeL9FfurM7S5VWx6aaOKbumeIRMraehTdjVqByf/AI4DfUdjlwAOwAeqseLkpJWZ5niVpqOV33L2gqz7or1JskVia0PI8tkn5uP0iP2Wb8WKtpCtW83X6RH7LN+LFW0hXs4Xlo+r8P8At4ntKUrQbRSlKAUpSgIZzm+BH9I/2rV16krSMI43fGM6FZsbs78Cto85v5OP6R+6rLmn43P1ifhrWGdNTr2fY8WpRVTGNPsa47nuvETfZSe6nc9z4ib7KT3V0JppprvhImn06Hc57Ntc+Im+yk91edzXPiJvspPdXQummmnCRHp0O5z33Nc+Im+yk91eG1ufETfZSe6uhdNNNOEiPT4dznnuW58RN9lJ7qdy3PiJvspPdXQ2mmmp4WI9Pj3Oeu5rnxE32Unup3Lc+Im+yk91dC6aaajhIj0+Hc567lufETfZSe6nc1z4ib7KT3V0LppppwkR6fDuc9dy3PiJvspPdQW1z4ib7KT3V0LppppwkR6fDuc9dzXPiJvspPdXvc1z4ib7KT3V0JppppwkR6fHuc9dy3PiJvspPdTuW58RN9lJ7q6F00004SI9Ph3Oe+5rnxE32UnuoiTqymSKRBkb2R1HHtIroTTUT5091kfpx/1iolhYqLOKmAgot3I3zcfpEfss34sVbSrVvN1+kR+yzfixVtKrMNy0aMByEe0pStBsFKUoBSlKAhnOb4Ef0j91WfNNxuvrE/DSrznN8CP6R+6rPml43P1ifhJWRfcP4PLh97L4K/L/AJW31m+YLJpolQNJJ3wCknhlQdwHE9VRKLnpcOBNZhVOD3suTg7wRlQCPTW2dq27SRsqnBIIrmzb+xEgvYYgxZGnkTfjcI7uSHG7yLn01qPVN8cjeUct2ZDJayW6qIzHr4uGBJzuwCN27jvqT1qfm+e8nuJC0jFI5HXeeOHIra4FFsQe0pSpApSlAKUpQClKUApSlAKUpQClKUB5US51fzI/WR/1CpbUS51PzI/WR/1CuZ+1ldbly+CN83H6RH7LN+JDW0K1fzcfpEfss34kNbQqrDctGfA8iJ9UpSrzYKUpQClKUBDOc3wI/pH7qtOabjc/WJ+ElXfOb4Ef0j91WfNKd9z9Yn4SVkX3D+Dy4fey+CfNXOnLhs7ThHZcz+3aExros1zryxX/AFSA9t3N7NoSitTPUNmc0A72f62T+s1PqgXNPuFz5JpP62q2uud3Z6SvE0VwdDMupUQq2k4JHfg449VQnoDYrEDfVE3SdtQm250tkSDLTNH5Hjkz/IGHtpcc5eyF390MfJ0c4z64wKXJSJobnPggn0V4ZXPYvn3/AHVHeTXLCzvXaO2eRig1OSjKFGcDJbt6vMazG072KKNpZWCogyWPV7z5KZiVG7si4Mzr+sOvHEVcJICMg7q1nJtPbV4xe0AhhJ7wuEGodpLqxOfIMeU1kOSO271Z2sb5R0uC6yLjTIgALYxgZGpeAHGojNNl9TDuKu2r9kybO5PXgVby3ehgCw38Ad2fMeGfJVWrXaZAjyU1gMpIwDgA7zg8a6ZQX0d2h4nB8u6qvTJ2irbyV8NGvHSKXFi/Br2rEsE0sBuyAfMdwPrq+qSGj2lKUIPKiXOp+ZH6yP8AqFS2olzqfmR+sj/qFcz9rK63Ll8Eb5uP0iP2Wb8SGto1q3m4/SI/ZZvxYq2lVOH5aM+B5ET2lKVoNgpSlAKUpQEL5zj3kf0j/arPmj43P1ifhrV3zo/k4/pH+1WfNCfzn6xPw1rKue/g8yH3svgm+0byOJDJK6xooyWYgKPOTXN/LXbMbXkM0ZDiN5JjjPhSXctwE84Rowew5roLlLsS1uo8XEQkCZKg53HGMgcM1oblHyUPTMLeBwoOBnLVo6npmyeaTadu73CxyKxeV5FAznQ7FhnyjIBqvzxbLaW1aRFQPCrShyO+Xo1LMAcb8gEYO6techtkzWlzHcNFJqQnG8qN4xvA4jycKn/LC+a5guupLeznZv1ppYmCr+7HqJB8YlLEmpuThktLm8ZVQyW0cgBIyFYTxxMyDtwWx56leztq7TlTUoyp4gqGU+cMCKiG2to9Ff7Q3AiWW5iPkDTh9Q/gFZrlByrg7g7jtXYnvS8iqyZCnOnfgjfjz44jrhrUlFzPey2NwskSLEk0UZmRQFWORHbWNPFVz3wHY2BuqdbEhfaRW5nBFsm+GI7ulI3dLIOscdK1G4tmLezRWp1dHbxxmR3JaS4ldFkOSfkgvk+etpbOg6ONU7AB2VCVy9PItN2VgANwG4dXZWJu1jNzHkfGL36nsXAR/XqQejyVlzWFufzxPqpD6pYqiTtscR6mcqhtBGaN1U4YqcHy9XtqsKVY9TnYttls5hQv4WkavPw91XFUNnBQpVeAY49O+rg1C2JYwGUqesYpsq7DqQSNaHSwzvBHaOqkZ3+esLtpuguIrkDCyFYJeA4sTC580haP/rL2VKOGSmlfCtkZFfdScnzUT51T/kj9ZH/WKllRLnW/Mj9ZH/WK5n7WV1vY/gjXNx+kf9rN+LFW0xWqubY/6j/tZvxYq2rVOG5aKMDyEe0pStBrFKUoBSlKAhPOmfio/pmrTmg/5n6xPw1q551fyUf0z9wq05nv+Z+sX8Nayrnv4POgv6x/BsOqfQp80eqqlK1HomP2vNFFFJLIBpRSx3bzgcB2k8B5TUW2zZtFsi8146R4LiSXHDpJEJYA9i7kHkQVl9tN01zFbDekemeXsyrfEofO4L+aLy1b8v5QLGaLdmVDEuTjfL3gJz5TXLZ0jRFw8gvNovGcMDPv6wGuUVtJ6iQxGfKav9iXM9xG9o69JEIpN7AMIZNJMTKx3r34AIHEE1Yxyxvc7R0sMSpcdEfnHp0kXHblVOK25yKsYLKw+PXosjLmRSrE9ZIIzUPclWsRnmqmle6Zpdz6Y1bhu0Iq/wBhV/yq5e7StLuSDuSMx6j0TOHQuoAJwxcqxznh6qw42zF3fClq7xRySESSaVyyDeVQMDxwBnqzx44k/L+yS8tJZM97FFLKMEbmjjZl9oFQmD75v+X4v5HhaHonRNeQ+pSMqvAgEHJ8vCpBKM3aMBu6Fx65I6575IbWNrcx3Bz0ZJSXHWjjD+nGGHlUVvHYd0WuNDHJSJwSOBzIhVh5CMEeQ1zUWx1BkuBqJc5fK07PhQxIHlkYhQ2dKhRlnOOI6qljHcSATjqHE+aufecnlK093cj5Kp0KDiF79C/p70j0mrL7I5bJXyb5eXEskZjtW+NkUSvktGoyOkMSZB4dZbdnrraccyt4JzXOVisirYhHIEsbnicD/MSofYorfPJa0eOFQzatw38c7uNFoTuZaqe1bNJ4HhfOmRCpI3EZGNQ7CDgjygVVBH/aqiEHtqQY/kjfPJDpl/Kxs0cg/XQ6WIHYdzDyMKzdRS4bua+SThHdARt5Jo1yp4fKiBX/AKS9tSsGpOGeVEudb8yP04/6xUtqI87B/wAk304/6xXM/ayqr7H8EY5sz/qP+1m/EhraorU/Ngf9S/2s34kNbYFVYf2IpwXIR9UpSrzUKUpQClKUBBudc/FRfSP3Va8znC5+sX8NauOdw4ii+mfuq05mG3XI/wD6L/QtZlz38HnwX9W3+xsWqF5cpHG0jnSiKzMx4Kqgkk+YCq9RDnEvl0LbkFlYNLMo64YiD0f/AFZDHH9Fn7K0N2V2eik27IuuTakQvcz9485Mz6jjo0IAjjOeGiIID+tqPXWo+czacN3OTG9xJjwMyIkSgbiUQR5xx74tk57MVT2xt++kV0mnLKx1MgwEBJ1aeGdI7M1X2LfXEcJVI4CrbyzIGd/O2d+KyyxC36Hrx8OcYXlq3t+xBFtO+wFLY7CaykpjXv8Ap5Y3xjj0h8uOBFS2xE9y2htEcY3t0SBCR2ZG/wBtR+82OjSEIp8IgeuueMg3YzrAS7mGgvihJiDM7bi772weIA+Tnzmpbye23dmC5t3kBiNpdErpXj0RAwcZ4kVkbTkYqQgtgO2/fjvR5+30VQfZTxW93MRhO5ZEB8rMij11VDGwqTUY9zvhowpyk+xh+VNnELGBolAZIbbpvKZUMkcvk3mVD295Uh5rdra+iYnLxKts/aUZtULdmAA8Z+inbUV28ZOkSIZINjaIwG8EdCkgOPI2k+isTybv2guEJcojMqyYGe81hiCOwEA9u6t7s1ZGBJx1N88vOVK28MkUILTlURAOAkmOI18rYDPp7F38RnSu3tlRAvHD3zW8bmaQ7xI6vGrlT5HcjzAHrrL321S7GVJNZhBcScOku5cGSVc/JjTSiZ4aEPXX3saBhsufUN7C6x5QEtn/APIfVXObUlxVrljY3aRx7Od4xIvRzKRnSd1xIe9bqPfVtvk1te3kxHBcmPrEMqjI3cFJ8Jc79xrTM35ps8/rXQ9Uin+9Ti/2OXiRwAwwOHVneDWXFYjyZLszVhqEasXd2ZtiKN/lFSO1dQ9hJqqI8b81qfYTXoVhFOU0Dhq3bu0HIovLC/Xc91AoHynMag+bO9vQKmli1PRIVMK4byRsnlLs4z27xqQJNzRMfkyoQ8bburUBnyE1U5LbSFxbpLjBIwynirA6WU+UMCD5q1cds385+LvI5G4hYpY9XnCHST6ql/JK6dLlkKMsd0hnAKkdHKCEnQjHe9/pffx6Rq006uZtNWM1WllSd0yc1D+dr8xb6af1iphUP52/zFvpp/WK7n7WZavsfwRTmtP+pf7Wb8WGttCtRc1J/wBS/wBrN+LDW3RXFBfQirCcmJ9UpSrTSKUpQClKUBBud9D3PE3ZLg+Yox+8CsNzNT4muE7RGw9Wn+1SrnMt9dhKfmaX9CsNX8uqtc82d50e0IwTgSIyekHUP71nelVPujFJZcSn3Rup2ABJ3ADeeytb3itcK9wCc3Dq6DgRbRhlgHmbLy/9Qbt1Sbl3dgQiHXoE2oSOP+HboNU75G8d53gI+VItRb/FFkzZF3Eq7tKkEaVAwFB3cBu4VRj5zjTywTbZ62FX15n0MU/JdZJS0g70gZG8ZPburNDYUCqFVR6cn+9fJ5S7P/8AFRfxV9HlPs4b+6YvQc/cK+flxUkk4v8A0erKvm3ZWhskjXSuFB4+Wvi2sIlYFU3qN2fLxOKtpeVmzR/zUe/sDfeF3Vib/lvs9QQkjPn5qMB5zq3tURw2Il/ayvzl3JLMQWBJ37xk7wPMOs+ysDy/2xbJD3NK35TBkUHv+jTEiggeCXkWMAccFjw31hBy1R8iJlR8YV5m0ovl0oGLeRQMVFOUEkbgE3VtI48IxW7oWJOSXcxLrPlr1MD4dKM889LbGTFVk1lizNckJunkE0hTEUSI4yNQSKMKH0eEw0qCSoPXVjy35OiF5J9WInIMRA1BnbS2g48HKFmB4HQRWD2Ovf6gckAjK6h4QK9QzwJqdtCtxYRLIxDLGi4IbGqMkAndxx1+U16FR+VPPffRlUISqQypEF2XqJCb8ZGcbyT2AdZzuqabY2nBbWzWrrolKTho9YkZGkjWJekK96jcTpBOAu/fuqNQ7PhDmKS7SDgdZWV856h0anHpxVTlRHE5DR3dpIcbzFCYCT1lvixkmr4wUnmKptxWUuOTiLcQwQ60EkEshCMyozpLoYFNZCuQ6sCuc4YYBraezNGhUbA3YyNwyOIz1EHO44rQy2xBySjD9V1PszmtmcjtsCSOVASZRE7Kucq7HCJq/fdPXWDxHCyquOUvw1VQi0zGcr7/AKZiIzpjZ2jjwMNL0f5SVyP+Gm8ADwj5jWNtriKHCwxo7/Kd0SRif3gQPMMenjX1tKUGS+dD3tusVtF2aBKELfvaWb981m+b2ztMdJLLFq7GZQfaatq2oUkorbscwfmSvIw13cRyDFzaRkH/AIkSrFKv6wKAI/mZd/aONX0KXYNtG1281ibiBgCxGY2kEZ4nUNJJRkz3pI6iDU+l7mYELJb+tT9xqHcq7IRQyBJUbLpLHowvRyKfCADHIYYBH6qnqqjC43zHlkmjurh7RzRNuckdupdw618JSVYdhBwawnPDLiyC/OljH8wNRTmM2gyzSwSHfJ8avlD5OR6cisvz0XX5vF2uXPmUH+5FelPSDPOrO0GzG80UZN+7fMt3H8cqY/prblav5k4SZLuXqCwxjzjWx+9a2jSkrQRxh42po9pSlWF4pSlAKUpQFptK1WSKSJvBkRkPmYEH7657gmeCZHO54Ze+86MVf/zequjq0fzqbM6G+dsd5OOkH0tyyAenDfv1TWW0uxlxEdproXnORse/vZY7m3lHRdEqKoZlI1d8+dO4gnT1/JHZUL/wLtTt/mf3Vtjme2kstsYXOXiOnzr8k+qp30C9lWp3VzTGV1dHNf8AgDabcQvpZvdVQc3e0/1f4m91dIiFeyvejXsFSdXZzd/+Ndodej+b3VVj5sL4/KQfxV0Z0S9lehB2UIOdxzWXnz1/hNfQ5rLvxg/hPvrobQOwU0DsFAc9x8214mf8wsY3cVl3/wAAPtr0c31yN/dkefoXH/t10C8KniBXx3KnYKWR0pyWzOf5ebi6dsmdZMjwgsm7HUekANfJ5q7vqcfwn310KkKjgK+tA7BQ5buc6y8192Plg/un31kOTnJmbZ5knnZQvxAzvHC6hdhn6KtW+jGvZWF5Y7BjvLSS2Y6dYGlgM6WU6lPrFQ9gc87N+MG0YR4ToZV8vQzB2AHWdBc/umvdmcjLyVA6FcHt1f2FUtqbIvLCbpSMNG5UsN4DEHwv1XU5HaGI4ggbq5n9pw3NkuAoeM6XQEbscGxxwR20J2NULyAv/noPtP7LVReb+9PGeMeiX/0V0O8UYGSAB5agvLDlfGksdpZFHuZGCk41JEDxZx1kDeF4n7407E5pdyL833JC6t7yO4a5VlQMrLplyVIOFBdQAM4PHqqhzobQ6W+IB3RIF/eY5PsxW1bu7iht2dnDGNO+Y6QWIG8kLuBz2VoK5nkmdnAJkmk70drSNpQe1a4qu8bLqZcQ9Mq6m4eZmz02BkI3zSySb/mjEa+xAfTU4qw2DYrBbxQLwjjRP4Rgn15q/qxKysXxVkke0pSpJFKUoBSlKA8qHc62xDc2hZBmSE9IgHFlxiRR51yfOoqY14RUNXVjmUVJWZzvyM24bS5SbPeNhZOzSTub0H2V0HbTK6h1OQwBB89aH5y+TncdydI+ImLNH2KeLx+g7x5D5Kk3NDyuxiynbePyTHrHzfOKrg7PKyik8jys2zSvAa9q00ilKUApSlAKUpQClKUArwivaUBBOcPZcoUyxRiQaSGUgHKk5KEEEOh3nSwODvUqd9aRuy0U2u2ElvICfBkYAeRT4SjPUWbz11M6AjB4VHdscjbOc5aMA9oqLA0aL7alyAs9+yx9ZaVuH0U3t5jWe5NwQ2+Us0aWdxpadxggHiI1ydAPbkk9vVWwYebeyU53n01c7b7i2ZbtKFUHGFHymbqFLA1ry2u5Io1tS5LP30u/gvHHpqtzRbHM98JmHxdsNZ7DIwxGvoGpvQKiN9dSzStIwLSSsMKN5JJwqL6wK37zfbBFlaJEcdI3fykdbtxGesKMKPNVcfqlfoZ4/XPN0RIxXtKVaaBSlKAUpSgFKUoBSlKAw3KzYcV5bvby7gwyrDwkceC6+Ue0ZFc87Z2fPaXDQygpIhBDDgwz3siH5p946q6eqM8uuSUF/DpfvJUBMcgGSh7D85D1r6sGuJRuVzjmRHubXl6s4W3uTplAAVjuEgHX562MK5f2/sm4s5+inUo671YE6XA4OjdY9o66m3IjnNkh0w3mXQbhJ8ofS7fPURl0ZEZPaRuylWGytrQXCB4ZFdT2Gr+rC0UpSgFKUoBSlKAUpSgFeV8sQN5qHcsuX1rZgop6WbqRd+D2k9QoQ3YkG39sQWsTSzMFAHpJ7BWgOWnKaW9nMj5Ea56NOoD5x8tWnKflDPeSGSdzgeCgPeqPN1ny1LubPm/e4Zbq8QrAMFI23NN1gsOqPyfK83Gtty0RTJuei2MnzNckSSNoTru/5dSO3cZSPWF85PZW2xXzGgAwNwG4AbgAOyvs12lZWLoqysj2lKVJIpSlAKUpQClKUApSlAKUpQGK5RbCtruMxXEYderqZT85W4qfNWluWPNteWuZIA1xCN/ej4xB+sg8Lzr6q37XhqGkzlxT3OVdlbVuIH1wSNGQd4B3eYrWwdgc7c6YW5j1j5ybj6jWxeU/InZ95lpYtMh/4kfeP6SNzfvA1rnbnM9cKS1rOki9SSDQ38SgqfUK5ytbHOWS2JxsnnI2bLgGTQex9331JLXbFtIMpKjeYiucdqckNpwflbSXA60XpV8+Y8genFYTpmRsZZGHEZZSPON2KZn2GaS3R1osyngw9dfWsdorlOHbNyvgzyjzOf71cDlLff8AiZf4qnMic6Ooy47R66pyXUa8XUeciuXn5Q3p43Mv8Rqzn2jM3hyyHzu3vpmIz/sdMbQ5VWMIzJOg9IqJbZ52bRMiBWlbtAwvrNaUsrSWU4iikkP6iO5/lBqU7I5utrTYPQdEpA76Vgn8oy/oIFRd9Bmk9kOUnODf3OV19Eh+SnEjymsBsnZ9xdS9HBG8sh44348rsdyjyk1tjk9zQ26ENdzNKfmJlE8xPhN6xWxdlbMgt0EcEaRqPkoAB5zjifKaZb7jI37iA8hea+KErNekSyjBWMb44z1Zz+UYdp3eStlAYr2ldosSse0pSgFKUoBSlKAUpSgFKUoBSlKAUpSgFKUoBXya9pQHyeHqqL8vPyZ8xpSjIkc4bW/Kv56tqUqtlR8mplzXflj/APesUpQ6Ohtl/k19FXlKV2jtCvaUqSTyvaUoBSlKAUpSgFKUoBSlKA//2Q==';


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
            } else if ($('#confirm_password').val() == $('input[name="password"]').val() && $('#confirm_password')
                .val().length > 5) {
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
