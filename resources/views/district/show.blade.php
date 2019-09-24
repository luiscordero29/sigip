@extends('layouts.app')

@section('content') <!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Distritos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/district') }}">Distritos</a></li>
                    <li class="breadcrumb-item active">Ver Distrito</li>
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
                <h3 class="card-title">Ver Distrito</h3>
            </div>
        </div>
        <div class="card-body">
            @include('layouts.alerts')
            <div class="form-group row mb-3 ">
                {!! Form::label('region', 'Región', ['class' => 'col-3 col-form-label']) !!}
                <div class="col-9">
                    {!! Form::text('region', $data['row']->province->region->description, ['readonly' => 'true', 'class' => 'form-control-plaintext', 'placeholder' => 'Descripción']) !!}       
                </div>
            </div>
            <div class="form-group row mb-3 ">
                {!! Form::label('province', 'Provincia', ['class' => 'col-3 col-form-label']) !!}
                <div class="col-9">
                    {!! Form::text('province', $data['row']->province->description, ['readonly' => 'true', 'class' => 'form-control-plaintext', 'placeholder' => 'Descripción']) !!}       
                </div>
            </div>
            <div class="form-group row mb-3 ">
                {!! Form::label('description', 'Descripción', ['class' => 'col-3 col-form-label']) !!}
                <div class="col-9">
                    {!! Form::text('description', $data['row']->description, ['readonly' => 'true', 'class' => 'form-control-plaintext', 'placeholder' => 'Descripción']) !!}       
                </div>
            </div>
            <div class="form-group row mb-3 ">
                {!! Form::label('observation', 'Observación', ['class' => 'col-3 col-form-label']) !!}
                <div class="col-9">
                    {!! Form::text('observation', $data['row']->observation, ['readonly' => 'true', 'class' => 'form-control-plaintext', 'placeholder' => 'Descripción']) !!}       
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url('district') }}" class="btn btn-default float-right"><i class="fa fa-undo"></i> Cancelar</a>
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
            $('#item-distritos a').addClass('active');
        });
    </script>
@endsection
