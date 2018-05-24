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

                @if(auth()->user()->estudianteEnRuta())

                    <div class="col-xs-12 col-md-8">
                        <h3>Ruta Activa <b>{{auth()->user()->rutaDelEstudiante()->nombre}}</b></h3>
                        {{--<button type="button" id="finalizar_ruta" value="{{auth()->user()->rutaActiva()->registro_rutas_id}}" class="btn btn-info waves-effect waves-light">Finalizar Ruta</button>--}}
                        <hr>
                        <div class="form-group">
                            <div id="map-estudiante" style=" height:480px;width:100%;position: relative; overflow: hidden; background-color: rgb(229, 227, 223);"></div>
                        </div>
                    </div>

                @else
                    <h1>Actualmente no está asignado a ninguna ruta el estudiante</h1>
                    <h1>{{auth()->user()->estduiante->name}}</h1>
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

        let estudianteID = '{{auth()->user()->estduiante->id}}';
        let map_estudiante;
        let marker_estudiante;

        $(document).ready(function() {
            $('#datatable').DataTable({
                "language": {
                    "url": "{{asset('assets/js/Spanish.json')}}"
                }
            });

            map_estudiante = new google.maps.Map(document.getElementById('map-estudiante'), {
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                zoom: 14,
                // center: {lat: lat, lng: long}
            });
            marker_estudiante = new google.maps.Marker({
                // position: {lat: lat, lng: long},
                animation: google.maps.Animation.DROP,
                map: map_estudiante
            });

            window.Echo.private(`estudiante.${estudianteID}`)
                .listen('RutaDelBus', (e) => {
                    let pos=new google.maps.LatLng(e.lat, e.long);

                    marker_estudiante.setPosition(pos);
                    map_estudiante.panTo(pos);
                    
                    if (!e.estado_ruta){
                        swal({
                            title: 'Ruta Finalizada',
                            text: 'El estudiante ya no se encuentra dentro del bus',
                            type: 'success',
                            showCancelButton: false,
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then(function () {
                            location.reload();
                        });
                    }

                    console.log(e);
                });

        });

    </script>
@endpush