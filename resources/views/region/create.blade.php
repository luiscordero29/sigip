@extends('layouts.app')

@section('content') <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Regiones</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/region') }}">Regiones</a></li>
                    <li class="breadcrumb-item active">Crear Región</li>
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
                <h3 class="card-title">Crear Región</h3>
            </div>
        </div>
        <div class="card-body">
            @include('layouts.alerts')
            {!! Form::open([
                'method'=>'POST',
                'url' => ['/region/store'],
                'class' => 'form-horizontal',
                'role' => 'form',
                'id' => 'form',
                ]) !!}
                <div class="form-group row mb-3 ">
                    {!! Form::label('description', 'Descripción', ['class' => 'col-3 col-form-label']) !!}
                    <div class="col-9">
                        {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Descripción']) !!}
                        @if ($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}</li>
                            </div>
                        @endif
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="card-footer">
            <button id="btn-submit" type="button" class="btn btn-info"><i class="fa fa-save"></i> Guardar</button>
            <a href="{{ url('region') }}" class="btn btn-default float-right"><i class="fa fa-undo"></i> Cancelar</a>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->  
</section>
<!-- /.content -->
@endsection

@section('scripts')
    <!-- DataTables -->
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#menu-division-politica').addClass('menu-open');
            $('#item-regiones a').addClass('active');
            // Save button
            $('#btn-submit').on('click', function() {
                submit();
            });
            // Save input
            $('.form-control').keypress(function (e) {
                if (e.which == 13) {
                    submit();
                    return false;
                }
            });
            // Save function
            function submit(){
                Swal.fire({
                    title: '¿Desea Guardar este registro?',
                    type: 'info',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, guardar!',
                    cancelButtonText: 'No, volver!',
                    confirmButtonClass: 'btn btn-confirm mt-2',
                    cancelButtonClass: 'btn btn-cancel ml-2 mt-2',
                }).then((result) => {
                    if (result.value) {
                        $('#form').submit();
                    }
                });
            }
            @if($errors->has('description')) 
                $('#description').addClass('is-invalid'); 
            @endif
        });
    </script>
@endsection
