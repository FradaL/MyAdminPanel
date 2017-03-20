@extends('layout')

@section('content-header')
    <h1> Usuarios </h1>
    <ol class="breadcrumb">
        <li>Usuarios</li>
        <li class="active">Crear</li>
    </ol>
@endsection
@section('content')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Crear Role</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="row">
                    <div class="col-md-8">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if (isset($role))
                            {!! Form::model($role, ['route' => ['role.update', $role->id], 'method' => 'post']) !!}
                        @else
                            {!! Form::open(['route' => 'role.create', 'method' => 'post']) !!}
                        @endif
                        <div class="form-group">
                            {{ Form::label('nick', 'Nombre del Role') }}
                            {{ Form::text('name', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('permission', 'Seleccione Permisos') }}
                            @if(isset($role))
                                {{ Form::select('permission[]', $permissions, $data, ['class' => 'form-control', 'multiple' => true]) }}
                            @else
                                {{ Form::select('permission[]', $permissions, null, ['class' => 'form-control', 'multiple' => true]) }}
                            @endif
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
