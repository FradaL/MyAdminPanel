@extends('layout')

@section('content-header')
    <h1> Roles </h1>
    <ol class="breadcrumb">
        <li class="active">Roles</li>
    </ol>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Roles</h3>
        </div>
        <div class="box-body">
            @if (\Session::has('Message'))
                <div class="alert alert-danger">
                    <p>{!! \Session::get('Message') !!}</p>
                </div>
            @endif
            <div class="col-md-6">
            </div>

            <div class="col-md-6 dataTables_filter">
                <a href="{{ url('role/create') }}" class="btn btn-info">Nuevo Role</a>
            </div>
        </div>
        <!-- /.box-header -->

        <div class="box-body">

            <table id="list-users" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Role</th>
                    <th>Permisos</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->name  }}</td>
                    <td>
                    @foreach($role->permissions as $permission)
                        @if(count($role->permissions) > 1)
                            {{ $permission->name . "," }}
                        @else
                            {{ $permission->name }}
                        @endif
                    @endforeach
                    </td>
                    <td>
                        <a href="{{ url('role/edit/' . $role->id) }}"><span class="btn btn-xs btn-success fa fa-pencil-square-o"></span></a>
                        <a href="#" class="button"  data-id="{{$role->id}}" data-token="{{ csrf_token() }}"><span class="btn btn-xs btn-danger fa fa-times"></span></a>
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
                            url: "{{ url('role/delete/') }}" + "/"+  id,
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
