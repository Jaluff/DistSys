<div class="modal" id="marca_modal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
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
                    <form action="#" class="form-horizontal" id="marca">
                        <div class="col-md-12">
                            <input type="hidden" value="" name="id_marca" id="id_marca" />
                            <div class="col-md-4">
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="marca_nombre">Nombre</label>
                                    <div class="col-md-8 col-xs-12">
                                        <input id="marca_nombre" name="marca_nombre" type="text" placeholder="" class="form-control input-sm">
                                    </div>
                                </div>
                                <!-- Select Basic -->
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="prov_localidad">Estado</label>
                                    <div class="col-md-8 ">
                                        <select id="marca_estado" name="marca_estado" class="form-control input-sm ">
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
                                        <button class="btn btn-success" onclick="guardar_marca(); " value="Guardar_marca" id="Guardar_marca">Guardar</button>
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
    function agregar_marca() {
        save_method = 'add';
        $('#marca')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#marca_modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Nueva marca'); // Set Title to Bootstrap modal title
    }

    function editar_marca(id) {
        save_method = 'update';
        $('#marca')[0].reset(); // reset form on modals
        //$('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $.ajax({
            url: "<?php echo base_url(); ?>marca/ajax_edit/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('#id_marca').val(data.id_marca);
                $('#marca_nombre').val(data.marca_nombre);
                $('#marca_estado').val(data.marca_estado);
                $('#marca_modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Editar Marca'); // Set title to Bootstrap modal title
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error al actualizar la marca');
            }
        });
    }

    function guardar_marca() {
        $('#Guardar_marca').text('guardando...'); //change button text
        $('#Guardar_marca').attr('disabled', true); //set button disable
        var url;
        if (save_method == 'add') {
            url = "<?php echo site_url('marca/ajax_add'); ?>";
        } else {
            url = "<?php echo site_url('marca/ajax_update'); ?>";
        }
        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#marca').serialize(),
            dataType: "JSON",
            success: function(datos) {
                if (datos.status) //if success close modal and reload ajax table
                {
                    console.log('datos: ' + datos);
                    $('#marca_modal').modal('hide');
                    reload_table();
                }
                $('#Guardar_marca').text('Guardar'); //change button text
                $('#Guardar_marca').attr('disabled', false); //set button enable
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error al guardar los cambios de esta marca');
                $('#Guardar_marca').text('Guardar'); //change button text
                $('#Guardar_marca').attr('disabled', false); //set button enable
            }
        });
    }

    function eliminar_marca(id) {
        if (confirm('Está seguro que desea eliminar esta marca?')) {
            // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('marca/ajax_delete') ?>/" + id,
                type: "POST",
                dataType: "JSON",
                success: function(data) {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    reload_table();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    alert('Error al elimnar esta marca');
                }
            });
        }
    }
   
</script> 