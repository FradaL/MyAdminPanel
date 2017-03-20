@extends('layout')

@section('content-header')
    <h1> Perfil </h1>
    <ol class="breadcrumb">
        <li>Perfil</li>
        <li class="active">Editar</li>
    </ol>
@endsection
@section('content')
        <div class="box">

            <div class="box-header">
                <h3 class="box-title">Editar Perfil</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if (\Session::has('Message'))
                    <div class="alert alert-success col-md-8">
                        <p>{!! \Session::get('Message') !!}</p>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-8">

                        {!! Form::model($user, ['route' => ['profile.update'], 'method' => 'put']) !!}

                        <div class="form-group">
                            {{ Form::label('nick', 'Nombre de Usuario') }}
                            {{ Form::label('username', $user->username, ['class' => 'form-control']) }}
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
                            {{ Form::submit('Guardar', ['class' => 'btn btn-info']) }}
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>

    <!-- /.box -->
@stop
