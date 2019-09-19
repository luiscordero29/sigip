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
                    <li class="breadcrumb-item active">Ver Provincia</li>
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
                <h3 class="card-title">Ver Provincia</h3>
            </div>
        </div>
        <div class="card-body">
            @include('layouts.alerts')
            <div class="form-group row mb-3 ">
                {!! Form::label('region', 'Región', ['class' => 'col-3 col-form-label']) !!}
                <div class="col-9">
                    {!! Form::text('region', $data['row']->region->description, ['readonly' => 'true', 'class' => 'form-control-plaintext', 'placeholder' => 'Descripción']) !!}       
                </div>
            </div>
            <div class="form-group row mb-3 ">
                {!! Form::label('description', 'Descripción', ['class' => 'col-3 col-form-label']) !!}
                <div class="col-9">
                    {!! Form::text('description', $data['row']->description, ['readonly' => 'true', 'class' => 'form-control-plaintext', 'placeholder' => 'Descripción']) !!}       
                </div>
            </div>
            <div class="form-group row mb-3 ">
                {!! Form::label('description', 'Descripción', ['class' => 'col-3 col-form-label']) !!}
                <div class="col-9">
                    {!! Form::text('description', $data['row']->description, ['readonly' => 'true', 'class' => 'form-control-plaintext', 'placeholder' => 'Descripción']) !!}       
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url('province') }}" class="btn btn-default float-right"><i class="fa fa-undo"></i> Cancelar</a>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->  
</section>
<!-- /.content -->
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#menu-division-politica').addClass('menu-open');
            $('#item-provincias a').addClass('active');
        });
    </script>
@endsection
