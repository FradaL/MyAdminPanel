@extends('layout')

@section('content-header')
    <h1> Usuarios </h1>
    <ol class="breadcrumb">
        <li>Usuarios</li>
        <li>Permisos</li>
        <li class="active">Crear </li>
    </ol>
@endsection
@section('content')
        <div class="box">

            <div class="box-header">
                <h3 class="box-title">Crear Permiso</h3>
                <br>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
            @if(isset($permission))
                {!! Form::model($permission, ['route' => ['permission.update', $permission->id], 'method' => 'post']) !!}
            @else
                {!! Form::open(['route' => 'permission.create', 'method' => 'post']) !!}
            @endif
                <div class="form-group">
                    {{ Form::label('nick', 'Nombre del Permiso') }}
                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                </div>
                <div class="form-group">
                    {{ Form::submit('Guardar', ['class' => 'btn btn-info']) }}
                </div>
                {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>

    <!-- /.box -->
@endsection
@section('scripts')
    @include('sweet::alert')
@endsection
