<div id="modal_editar_zona" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Formulario Editar Zona</h4>
            </div>

            <form method="POST" autocomplete="off" id="form_editar_zona">

                {{csrf_field()}}

                <input type="hidden" name="id" id="modal_editar_zona_id" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre" class="control-label">Nombre</label>
                                <input type="text" class="form-control" id="modal_editar_zona_nombre" name="nombre" placeholder="Ej: Aula 301" data-remote="{{route('zona.validar')}}" data-remote-method="POST" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="descripcion" class="control-label">Descripción</label>
                                <input type="text" class="form-control" id="modal_editar_zona_descripcion" name="descripcion" placeholder="" data-remote="{{route('zona.validar')}}" data-remote-method="POST">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hora_inicio" class="control-label">Hora Inicio</label>
                                <input type="text" class="form-control" id="modal_editar_zona_hora-inicio" name="hora_inicio" placeholder="Ej: 8am" data-remote="{{route('zona.validar')}}" data-remote-method="POST" required onkeydown="return false">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="hora_fin" class="control-label">Hora Fin</label>
                                <input type="text" class="form-control" id="modal_editar_zona_hora-fin" name="hora_fin" placeholder="Ej: 10pm" data-remote="{{route('zona.validar')}}" data-remote-method="POST" required onkeydown="return false">
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Editar Zona</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form_editar_zona').validator();

            $('#modal_editar_zona_hora-inicio').timepicker({
                'scrollDefault': '7am'
            });
            $('#modal_editar_zona_hora-fin').timepicker({
                'scrollDefault': '10pm'
            });
        });
    </script>

@endpush