<div id="modal_agregar_zona" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Formulario Agregar Zona</h4>
            </div>

            <form action="{{route('zona.store')}}" method="POST" autocomplete="off" id="form_agregar_zona">
                {{method_field('POST')}}
                {{csrf_field()}}

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ej: Aula 301" data-remote="{{route('zona.validar')}}" data-remote-method="POST" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion" class="control-label">Descripción</label>
                                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="" data-remote="{{route('zona.validar')}}" data-remote-method="POST">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hora_inicio" class="control-label">Hora Inicio</label>
                                <input type="text" class="form-control" id="hora_inicio" name="hora_inicio" placeholder="Ej: 8am" data-remote="{{route('zona.validar')}}" data-remote-method="POST" required onkeydown="return false">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hora_fin" class="control-label">Hora Fin</label>
                                <input type="text" class="form-control" id="hora_fin" name="hora_fin" placeholder="Ej: 10pm" data-remote="{{route('zona.validar')}}" data-remote-method="POST" required onkeydown="return false">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Agregar Zona</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form_agregar_zona').validator();
            $('#hora_inicio').timepicker({
                'scrollDefault': '7am'
            });
            $('#hora_fin').timepicker({
                'scrollDefault': '10pm'
            });

//            $('#form_agregar_usuario').on('submit',function (e) {
//                e.preventDefault();
//                $('#password').val(sha3_224($('#password').val()));
//                this.submit();
//            })

        });
    </script>

@endpush