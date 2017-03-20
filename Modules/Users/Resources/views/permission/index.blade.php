@extends('layout')

@section('content-header')
    <h1> Usuarios </h1>
    <ol class="breadcrumb">
        <li class="active">Permisos</li>
    </ol>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('content')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Lista de Permisos</h3>
        </div>
        <div class="box-body">
            <div class="col-md-6">

            </div>
            <div class="col-md-6 dataTables_filter">
                <a href="{{ url('permission/create') }}" class="btn btn-info">Nuevo Permiso</a>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body">
            <table id="list-users" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Permiso</th>
                    <th>Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->name  }}</td>
                    <td>
                        <a href="{{ url('permission/edit/'. $permission->id) }}"><span class="btn btn-xs btn-success fa fa-pencil-square-o"></span></a>
                        <a href="#" class="button"  data-id="{{$permission->id}}" data-token="{{ csrf_token() }}"><span class="btn btn-xs btn-danger fa fa-times"></span></a>
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
                            url: "{{ url('permission/delete/') }}" + "/"+  id,
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
