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




                    <div class="col-xs-12 col-md-8">
                        <h3>Ruta Activa <b>{{auth()->user()->rutaActiva()->nombre}}</b></h3>
                        <button type="button" id="finalizar_ruta" value="{{auth()->user()->rutaActiva()->registro_rutas_id}}" class="btn btn-info waves-effect waves-light">Finalizar Ruta</button>
                        <hr>
                        <div class="form-group">
                            <div id="map" style=" height:480px;width:100%;position: relative; overflow: hidden; background-color: rgb(229, 227, 223);"></div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <h3>Estudiantes activos</h3>

                        <table id="estudiantes" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Estado</th>

                            </tr>
                            </thead>

                            <tbody>
                            </tbody>
                        </table>

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
        let map;
        let wpid;
        let marker;
        let geo_options = {
            enableHighAccuracy: true,
            maximumAge        : 30000,
            timeout           : 27000
        };
        let url_familiar = '{{url('actualizarRutaAFamiliar')}}';
        let conductor_id = '{{auth()->user()->id}}'

        $(document).ready(function() {

            $('#datatable').DataTable({
                "language": {
                    "url": "{{asset('assets/js/Spanish.json')}}"
                }
            });
            map = new google.maps.Map(document.getElementById('map'), {
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                zoom: 14,
                // center: {lat: lat, lng: long}
            });

            marker = new google.maps.Marker({
                // position: {lat: lat, lng: long},
                animation: google.maps.Animation.DROP,
                map: map
            });

            navigator.geolocation.watchPosition(geo_success, geo_error, geo_options);

            window.Echo.channel('rfid')
                .listen('CapturarRfid', (e) => {
                    populateTable();

                    console.log(e);

                });

            populateTable();

        });

        function geo_success(position) {
            do_something(position.coords.latitude, position.coords.longitude);
        }

        function geo_error() {
            alert("Sorry, no position available.");
        }

        function do_something(lat, long) {
            marker.setPosition({lat: lat, lng: long});
            map.panTo({lat: lat, lng: long});

            $.ajax({
                type: 'GET',
                url: url_familiar,
                data:{lat: lat, lng: long, conductor_id:conductor_id},
                success: function (data) {
                    console.log(data)
                },
                error: function (JqXhr) {
                    console.log(JqXhr);
                }
            });

        }

        function populateTable() {
            $.ajax({
                type: 'GET',
                url: '{{url('estudiantes-ruta')}}',
                success: function (data) {

                    console.log(data);

                    var table = $('#estudiantes > tbody');
                    table.empty();
                    _.each(data,function (item) {

                        if (item.estado_ruta==="1") {
                            item.estado_ruta="En ruta";

                            table.append
                            ("<tr class='success'>" +
                                "<td>"+item.users_name+"</td>" +
                                "<td>"+item.estado_ruta+"</td>" +
                            "</tr>");

                        }else if(item.estado_ruta==="0"){
                            item.estado_ruta="Fuera de Ruta";

                            table.append
                            ("<tr class='danger'>" +
                                "<td>"+item.users_name+"</td>" +
                                "<td>"+item.estado_ruta+"</td>" +
                            "</tr>");

                        }

                    });
                }
            });
        }

        $('#iniciar_ruta').on('click', function (e) {
            e.preventDefault();

            var id = $('select[name=ruta]').val();

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

        $('#finalizar_ruta').on('click', function (e) {
            e.preventDefault();

            var id = $(this).val();

            swal({
                title: 'Finalizar Ruta',
                text: "¿Desea finalizar la Ruta?",
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
                    url: '{{url('finalizar-ruta')}}/' + id,
                    success: function (data) {
                        swal({
                            title: 'Ruta Finalizada',
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
                        console.log(jqXHR);
                        swal(
                            'Ha ocurrido un error',
                            jqXHR.responseJSON.message,
                            // errorThrown,
                            'error'
                        );

                    }
                });
            });
        });


    </script>
@endpush