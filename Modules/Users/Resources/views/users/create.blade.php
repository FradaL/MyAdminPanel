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
                <h3 class="box-title">Crear Usuario</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row">
                    <div class="col-md-8">
                        @if(isset($user))
                            {!! Form::model($user, ['route' => ['user.update', $user->id], 'method' => 'put']) !!}
                        @else
                            {!! Form::open(['route' => 'user.create', 'method' => 'post']) !!}
                        @endif
                        <div class="form-group">
                            {{ Form::label('nick', 'Nombre de Usuario') }}
                            {{ Form::text('username', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('name', 'Nombre Completo') }}
                            {{ Form::text('name', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('mail', 'Email') }}
                            {{ Form::text('email', null, ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('pw', 'Password') }}
                            {{ Form::password('password', ['class' => 'form-control']) }}
                        </div>
                        <div class="form-group">
                            {{ Form::label('select', 'Asignar Role') }}
                            @if(isset($user))

                                {{ Form::select('role[]', $roles, $user->roles->pluck('name')->toArray(), ['id'=>'role_id', 'class' => 'form-control', 'multiple' => true]) }}
                            @else
                                {{ Form::select('role[]', $roles, null,['id'=>'role_id', 'class' => 'form-control', 'multiple' => true]) }}
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
