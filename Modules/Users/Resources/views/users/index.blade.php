@extends('layout')

@section('content-header')
    <h1> Usuarios </h1>
    <ol class="breadcrumb">
        <li class="active">Usuarios</li>
    </ol>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Usuarios</h3>
        </div>
        <div class="box-body">
            <div class="col-md-6">
                @if (\Session::has('Message'))
                    <div class="alert alert-danger">
                        <p>{!! \Session::get('Message') !!}</p>
                    </div>
                @endif
            </div>
            <div class="col-md-6 dataTables_filter">
                <a href="{{ url('users/create') }}" class="btn btn-info">Nuevo Usuario</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="list-users" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Usuario</th>
                    <th>Nombre Completo</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                   @foreach($user->roles as $role)
                       {{ $role->name }} <br>
                    @endforeach
                    </td>
                    <td>
                        <a href="{{ url('users/edit/' . $user->id) }}"><span class="btn btn-xs btn-success fa fa-pencil-square-o"></span></a>
                        <a href="#" class="button"  data-id="{{$user->id}}" data-token="{{ csrf_token() }}"><span class="btn btn-xs btn-danger fa fa-times"></span></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
@endsection

@section('scripts')
    @include('sweet::alert')

    <script>
        $('.button').click(function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            var token = $(this).data('token');

            swal({
                        title: "¿estas seguro?",
                        type: "warning",
                        confirmButtonClass: "btn-danger",
                        confirmButtonText: "Sí, Eliminar!",
                        cancelButtonText: "No, Cancelar!",
                        showCancelButton: true,
                    },
                    function() {
                        $.ajax({
                            type: "post",
                            url: "{{ url('users/delete/') }}" + "/"+  id,
                            data: { id:id},
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function () {
                                location.reload();
                            }
                        });
                    });
        });
    </script>

@endsection
