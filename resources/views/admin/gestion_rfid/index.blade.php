@extends('layouts.dashboard')

@section('titulo', 'Gestión de Rfid')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <div class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                        <i class="zmdi zmdi-more-vert"></i>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                    </ul>
                </div>

                <button class="btn btn-primary waves-effect waves-light btn-lg m-b-5" data-toggle="modal" data-target="#modal_agregar_rfid">Agregar Rfid</button>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @include('flash::message')

                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Serial</th>
                        <th>Usuario Asignado</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($rfids as $rfid)
                        <tr data-id="{{$rfid->id}}" class="{{($rfid->trashed() ? 'danger': false)}}">
                            <td>{{$rfid->serial}}</td>
                            <td>{{($rfid->user===null)?"No ha sido asingado":$rfid->user->name}}</td>

                            <td>
                                @if($rfid->trashed())
                                    {{--<a href="#" class="editar"><i class="fa fa-pencil fa-lg" style="color: #10c469"></i></a>--}}
                                    <a href="#" class="restaurar"><i class="fa fa-undo fa-lg" style="color: #0c7cd5"></i></a>
                                @else
                                    {{--<a href="#" class="editar"><i class="fa fa-pencil fa-lg" style="color: #10c469"></i></a>--}}
                                    <a href="#" class="eliminar"><i class="fa fa-trash-o fa-lg" style="color: #ff5b5b"></i></a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- end col -->
    </div>
@endsection

@section('modals')
    @include('admin.gestion_rfid.includes.modal_agregar_rfid')
    {{--@include('admin.gestion_rfid.includes.modal_editar_rfid')--}}
@endsection

@push('script')
<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            "language": {
                "url": "{{asset('assets/js/Spanish.json')}}"
            }
        });
    });

    $('.eliminar').on('click', function (e) {
        e.preventDefault();

        var fila = $(this).parents('tr');
        var id = fila.data('id');

        swal({
            title: 'Eliminar usuario',
            text: "¿Estas seguro de eliminar este usuario?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1ccc51',
            confirmButtonText: 'Si'
        }).then(function () {
            $.ajax({
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{url('gestion-rfid')}}/' + id,
                success: function (data) {
                    swal({
                        title: 'Eliminado!',
                        text: data,
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then(function () {
                        location.reload();
                    });
                },
                error:function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                    swal(
                        'Ha ocurrido un error',
                        jqXHR.responseText,
                        'error'
                    );

                }
            });
        });
    });

    $('.restaurar').on('click', function (e) {
        e.preventDefault();

        var fila = $(this).parents('tr');
        var id = fila.data('id');

        swal({
            title: 'Restaurar Usuario',
            text: "¿Esta seguro de restaurar este usuario?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#1ccc51',
            confirmButtonText: 'Si'
        }).then(function () {
            $.ajax({
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{url('restaurar-rfid')}}/' + id,
                success: function (data) {
                    swal({
                        title: 'Restaurado!',
                        text: data,
                        type: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then(function () {
                        location.reload();
                    });
                },
                error:function (jqXHR, textStatus, errorThrown) {
                    console.log(jqXHR.responseText);
                    swal(
                        'Ha ocurrido un error',
                        jqXHR.responseText,
                        'error'
                    );

                }
            });
        });
    });

</script>
@endpush