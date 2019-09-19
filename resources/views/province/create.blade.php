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
                    <li class="breadcrumb-item"><a href="{{ url('/province') }}">Provincias</a></li>
                    <li class="breadcrumb-item active">Crear Provincia</li>
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
                <h3 class="card-title">Crear Provincia</h3>
            </div>
        </div>
        <div class="card-body">
            @include('layouts.alerts')
            {!! Form::open([
                'method'=>'POST',
                'url' => ['/province/store'],
                'class' => 'form-horizontal',
                'role' => 'form',
                'id' => 'form',
                ]) !!}
                <div class="form-group row mb-3 ">
                    {!! Form::label('region_id', 'Región', ['class' => 'col-3 col-form-label']) !!}
                    <div class="col-9">
                        {!! Form::select('region_id', $data['region'], old('region_id'), ['placeholder' => 'Seleccione...', 'class' => 'form-control select2']) !!}
                        @if ($errors->has('region_id'))
                            <div class="invalid-feedback">
                                {{ $errors->first('region_id') }}</li>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row mb-3 ">
                    {!! Form::label('description', 'Provincia', ['class' => 'col-3 col-form-label']) !!}
                    <div class="col-9">
                        {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Provincia']) !!}
                        @if ($errors->has('description'))
                            <div class="invalid-feedback">
                                {{ $errors->first('description') }}</li>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="form-group row mb-3 ">
                    {!! Form::label('observation', 'Observación', ['class' => 'col-3 col-form-label']) !!}
                    <div class="col-9">
                        {!! Form::text('observation', old('observation'), ['class' => 'form-control', 'placeholder' => 'Observación']) !!}
                        @if ($errors->has('observation'))
                            <div class="invalid-feedback">
                                {{ $errors->first('observation') }}</li>
                            </div>
                        @endif
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
        <div class="card-footer">
            <button id="btn-submit" type="button" class="btn btn-info"><i class="fa fa-save"></i> Guardar</button>
            <a href="{{ url('province') }}" class="btn btn-default float-right"><i class="fa fa-undo"></i> Cancelar</a>
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
    <script src="{{ asset('js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#menu-division-politica').addClass('menu-open');
            $('#item-provincias a').addClass('active');
            $('.select2').select2({
                theme: 'bootstrap4',
            });
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
            @if($errors->has('region_id')) 
                $('#region_id').addClass('is-invalid'); 
            @endif
            @if($errors->has('description')) 
                $('#description').addClass('is-invalid'); 
            @endif
            @if($errors->has('observation')) 
                $('#observation').addClass('is-invalid'); 
            @endif
        });
    </script>
@endsection
