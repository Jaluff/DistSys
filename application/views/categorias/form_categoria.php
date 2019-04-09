<div class="modal" id="categoria_modal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal_grande" role="document">>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel"></h3>
            </div>
            <div class="modal-body">
                <?php if (isset($message)) { ?>
                <div id="infoMessage" class="alert alert-success" role="alert">
                    <?php echo $message; ?>
                </div>
                <?php 
            } ?>
                <div class="row">
                    <form action="#" class="form-horizontal" id="categoria">
                        <div class="col-md-12">
                            <input type="hidden" value="" name="id_categoria" id="id_categoria" />
                            <div class="col-md-4">
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="categoria_nombre">Nombre</label>
                                    <div class="col-md-8 col-xs-12">
                                        <input id="categoria_nombre" name="categoria_nombre" type="text" placeholder="" class="form-control input-sm">
                                    </div>
                                </div>
                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="prov_localidad">Estado</label>
                                    <div class="col-md-8 ">
                                        <select id="categoria_estado" name="categoria_estado" class="form-control input-sm ">
                                            <option value="1">Aciva</option>
                                            <option value="0">No activa</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <div class="text-center">
                                    <div class="form-group">
                                        <button class="btn btn-success" onclick="guardar_categoria(); " value="Guardar_categoria" id="Guardar_categoria">Guardar</button>
                                        <!-- <button id="Guardarymascota" name="GuardarMascota" class="btn btn-info">Guardar y agregar mascota</button> -->
                                        <button id="Cancelar" name="Cancelar" data-dismiss="modal" class="btn btn-warning">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    /*
     *   funciones para la gestion de clientes
     */
    function agregar_categoria() {
        save_method = 'add';
        $('#categoria')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#categoria_modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Nueva categoria'); // Set Title to Bootstrap modal title
    }

    function editar_categoria(id) {
        save_method = 'update';
        $('#categoria')[0].reset(); // reset form on modals
        //$('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $.ajax({
            url: "<?php echo base_url(); ?>categoria/ajax_edit/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#id_categoria').val(data.id_categoria);
                $('#categoria_nombre').val(data.categoria_nombre);
                $('#categoria_estado').val(data.categoria_estado);
                $('#categoria_modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Editar categoria'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error al actualizar la categoria');
            }
        });
    }

    function guardar_categoria() {
        $('#Guardar_categoria').text('guardando...'); //change button text
        $('#Guardar_categoria').attr('disabled', true); //set button disable
        var url;
        if (save_method == 'add') {
            url = "<?php echo site_url('categoria/ajax_add'); ?>";
        } else {
            url = "<?php echo site_url('categoria/ajax_update'); ?>";
        }
        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#categoria').serialize(),
            dataType: "JSON",
            success: function(datos) {
                if (datos.status) //if success close modal and reload ajax table
                {
                    console.log('datos: ' + datos);
                    $('#categoria_modal').modal('hide');
                    reload_table();
                }
                $('#Guardar_categoria').text('Guardar'); //change button text
                $('#Guardar_categoria').attr('disabled', false); //set button enable
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error al guardar los cambios de esta categoria');
                $('#Guardar_categoria').text('Guardar'); //change button text
                $('#Guardar_categoria').attr('disabled', false); //set button enable
            }
        });
    }

    function eliminar_categoria(id) {
        if (confirm('Está seguro que desea eliminar esta categoria?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('categoria/ajax_delete') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    reload_table();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error al elimnar esta categoria');
                }
            });
        }
    }
   
</script> 