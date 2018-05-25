<div id="modal_agregar_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Formulario Agregar Ruta</h4>
            </div>

            <form action="{{route('usuario.store')}}" method="POST" autocomplete="off" id="form_agregar_usuario">
                {{method_field('POST')}}
                {{csrf_field()}}

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="name" class="control-label">Nombre Ruta</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Ej: " data-remote="{{route('usuario.validar')}}" data-remote-method="POST" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="conductor" class="control-label">Conductor</label>
                                <select id="conductor" name="conductor" class="form-control" data-remote="{{route('ruta.validar')}}" data-remote-method="POST" required>
                                    <option value="">Escoge un Conductor</option>
                                    @foreach($users as $user)
                                        @if ($user->hasRole('conductor'))
                                            <option value="{{$user->id}}" >{{$user->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="acompanante" class="control-label">Acompañante</label>
                                <select id="acompanante" name="acompanante" class="form-control" data-remote="{{route('ruta.validar')}}" data-remote-method="POST" required>
                                    <option value="">Escoge un Acompañante</option>
                                    @foreach($users as $user)
                                        @if ($user->hasRole('profesor'))
                                            <option value="{{$user->id}}" >{{$user->name}}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Agregar Ruta</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form_agregar_usuario').validator();

//            $('#form_agregar_usuario').on('submit',function (e) {
//                e.preventDefault();
//                $('#password').val(sha3_224($('#password').val()));
//                this.submit();
//            })

        });
    </script>

@endpush