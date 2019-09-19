@extends('layouts.app')

@section('content') <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Provincias</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">División Politica</li>
                    <li class="breadcrumb-item active">Provincias</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col">
                    <h3 class="card-title">Mantenedor de Provincias</h3>
                </div>
                <div class="col">
                    <ul class="nav nav-pills card-header-pills justify-content-end">
                        <li class="nav-item">
                            <a class="nav-link active" href="{{ url('/province/create') }}"><i class="far fa-plus-square"></i> Registar</a>
                        </li>        
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <table id="datatable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Región</th>
                        <th>Provincia</th>
                        <th width="1%"></th>
                    </tr>
                </thead>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->  
</section>
<!-- /.content -->
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{ asset('js/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/dataTables.bootstrap4.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#menu-division-politica').addClass('menu-open');
            $('#item-provincias a').addClass('active');
            $('#datatable').DataTable( {
                processing: true,
                serverSide: true,                
                ajax: {
                    url: '{{ url("province/json") }}',
                },
                columns: [
                    {data: 'region', name: 'regions.description'},
                    {data: 'description', name: 'provinces.description'},
                    {
                        data: null,
                        render: function ( data, type, row ) {
                            buttons = '<div class="btn-group">';
                            buttons = buttons.concat('<button type="button" data-id="'+row.province_id+'" data-toggle="tooltip" data-placement="top" title="Ver" class="btn btn-default btn-sm btn-show"><i class="far fa-eye"></i></button>');
                            buttons = buttons.concat('<button type="button" data-id="'+row.province_id+'" data-toggle="tooltip" data-placement="top" title="Editar" class="btn btn-info btn-sm btn-edit"><i class="far fa-edit"></i></button>');
                            buttons = buttons.concat('<button type="button" data-id="'+row.province_id+'" data-toggle="tooltip" data-placement="top" title="Eliminar" class="btn btn-danger btn-sm btn-destroy"><i class="fas fa-trash"></i></button>');
                            buttons = buttons.concat('</div>');
                            return buttons;
                        },
                        searchable: false,
                        orderable: false,
                    },
                ],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior",
                    }
                },
            });    
        });
        $(document).on('click', '.btn-show', function(){ 
            let id = $(this).data('id');
            let url = '{{ url("province/show") }}'+'/'+id;
            $(location).attr('href', url);
        });
        $(document).on('click', '.btn-edit', function(){ 
            let id = $(this).data('id');
            let url = '{{ url("province/edit") }}'+'/'+id;
            $(location).attr('href', url);
        });
        $(document).on('click', '.btn-destroy', function(){ 
            let id = $(this).data('id');
            let url = '{{ url("province/destroy") }}'+'/'+id;
            Swal.fire({
                title: '¿Estás seguro?',
                text: "¡No podrás revertir esto!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar!',
                cancelButtonText: 'No, volver!',
                confirmButtonClass: 'btn btn-secondary mt-2',
                cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
            }).then((result) => {
                if (result.value) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        success: function (data) {
                            $('#datatable').DataTable().clear().draw();
                            if(data.status == '1') {
                                Swal.fire({
                                    type: 'success',
                                    title: 'Exito',
                                    text: 'Registro Eliminado!',
                                });
                            } else {
                                Swal.fire({
                                    type: 'error',
                                    title: 'Error',
                                    text: 'No se borro el registro!',
                                });
                            }
                        },
                        error: function (data) {
                            Swal.fire({
                                type: 'error',
                                title: 'Error',
                                text: 'No se borro el registro!',
                            });
                        }
                    })
                }
            });
        });
    </script>
@endsection