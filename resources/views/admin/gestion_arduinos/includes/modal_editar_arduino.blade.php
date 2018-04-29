<div id="modal_editar_arduino" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Formulario Editar Arduino</h4>
            </div>

            <form method="POST" autocomplete="off" id="form_editar_arduino">

                {{csrf_field()}}

                <input type="hidden" name="id" id="modal_editar_arduino_id" value="">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_editar_arduino_id_arduino" class="control-label">Id Arduino</label>
                                <input type="text" class="form-control" id="modal_editar_arduino_id_arduino" name="id_arduino" placeholder="Ej: 123456789" data-remote="{{route('arduino.validar')}}" data-remote-method="POST" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="modal_editar_arduino_zona" class="control-label">Zona</label>
                                <select id="modal_editar_arduino_zona" name="zona" class="form-control" data-remote="{{route('arduino.validar')}}" data-remote-method="POST" required>
                                    <option value="">Escoge una Zona</option>
                                    @foreach($zonas as $zona)
                                        <option value="{{$zona->id}}" >{{$zona  ->nombre}}</option>
                                    @endforeach
                                </select>

                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Editar Arduino</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form_editar_arduino').validator();
        });
    </script>

@endpush