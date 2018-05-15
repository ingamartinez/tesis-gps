@extends('layouts.dashboard')

@section('titulo', 'Gestión de usuarios')

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

                @if(auth()->user()->hasRutaActiva())

                    <h3>Ruta Activa <b>{{auth()->user()->nombreRutaActiva()}}</b></h3>
                    <div id="map" style=" height:480px;width:100%;position: relative; overflow: hidden; background-color: rgb(229, 227, 223);">

                    </div>
                @else
                    <h3>Mis rutas</h3>

                    <div class="row">
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="ruta" class="control-label">Rutas</label>
                                <select id="ruta" name="ruta" class="form-control" required>
                                    <option value="">Escoge una Ruta</option>

                                    @foreach($rutas as $ruta)

                                        <option value="{{$ruta->id}}" >{{$ruta->nombre}}</option>

                                    @endforeach

                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-3">
                            <div class="form-group">
                                <label for="acudiente" class="control-label"> </label>
                                <br>
                                <button type="button" id="iniciar_ruta" class="btn btn-info waves-effect waves-light">Iniciar Ruta</button>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>

                    </div>
                @endif
            </div>
        </div><!-- end col -->
    </div>
@endsection

@section('modals')
    {{--@include('admin.gestion_rutas.includes.modal_agregar_ruta')--}}
    {{--@include('admin.gestion_rutas.includes.modal_editar_ruta')--}}
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

        $('#iniciar_ruta').on('click', function (e) {
            e.preventDefault();

            let id = $('select[name=ruta]').val();

            swal({
                title: 'Iniciar Ruta',
                text: "¿Desea iniciar la Ruta?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#1ccc51',
                confirmButtonText: 'Si'
            }).then(function () {
                $.ajax({
                    type: 'PUT',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{url('rutas-conductor')}}/' + id,
                    success: function (data) {
                        swal({
                            title: 'Ruta Iniciada',
                            text: data.message,
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
                            // errorThrown,
                            'error'
                        );

                    }
                });
            });
        });


    </script>
@endpush