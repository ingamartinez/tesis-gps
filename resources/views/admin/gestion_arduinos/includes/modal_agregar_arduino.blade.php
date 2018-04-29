<div id="modal_agregar_arduino" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Formulario Agregar Arduino</h4>
            </div>

            <form action="{{route('arduino.store')}}" method="POST" autocomplete="off" id="form_agregar_arduino">
                {{method_field('POST')}}
                {{csrf_field()}}

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_arduino" class="control-label">Id Arduino</label>
                                <input type="text" class="form-control" id="id_arduino" name="id_arduino" placeholder="Ej: 123456789" data-remote="{{route('arduino.validar')}}" data-remote-method="POST" required>
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="zona" class="control-label">Zona</label>
                                <select id="zona" name="zona" class="form-control" data-remote="{{route('arduino.validar')}}" data-remote-method="POST" required>
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
                    <button type="submit" class="btn btn-info waves-effect waves-light">Agregar Arduino</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form_agregar_arduino').validator();

//            $('#form_agregar_usuario').on('submit',function (e) {
//                e.preventDefault();
//                $('#password').val(sha3_224($('#password').val()));
//                this.submit();
//            })

        });
    </script>

@endpush