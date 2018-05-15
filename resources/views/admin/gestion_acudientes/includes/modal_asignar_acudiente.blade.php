<div id="modal_editar_usuario" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Formulario Editar Usuario</h4>
            </div>

            <form method="POST" autocomplete="off" id="form_editar_usuario">

                {{csrf_field()}}

                <input type="hidden" name="id" id="modal_editar_usuario_id" value="">

                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label for="acudiente" class="control-label">Acudiente</label>
                            <select id="acudiente" name="acudiente" class="form-control" data-remote="{{route('acudiente.validar')}}" data-remote-method="POST">
                                <option value="">Escoge un Acudiente</option>

                                @foreach($users as $user)
                                    @if($user->isRole(4))
                                        <option value="{{$user->id}}" >{{$user->name}}</option>
                                    @endif
                                @endforeach

                            </select>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-info waves-effect waves-light">Editar Usuario</button>
                </div>
            </form>
        </div>
    </div>
</div><!-- /.modal -->

@push('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#form_editar_usuario').validator();
        });
    </script>

@endpush