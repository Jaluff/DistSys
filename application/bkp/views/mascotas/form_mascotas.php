<div class="modal" id="mascota_modal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal_chico modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel"></h3> </div>
            <div class="modal-body">
                <?php  if (isset($message)){ ?>
                    <div id="infoMessage" class="alert alert-success" role="alert">
                        <?php echo $message;?>
                    </div>
                    <?php } ?>
                        <div class="row">

                                <form action="#" class="form-horizontal" id="form_mascota">
                                    <div class="col-md-12">
                                    <input type="hidden" value="" name="id_cli" id="id_cli"  />
                                    <div class="col-md-6">
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-5  control-label" for="nombre_mascota">Nombre</label>
                                            <div class="col-md-7 ">
                                                <input id="nombre_mascota" name="nombre_mascota" type="text" placeholder="" class="form-control input-sm" >
                                            </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-5 control-label" for="peso">Peso</label>
                                            <div class="col-md-7 ">
                                                <input id="peso" name="peso" type="text" placeholder="" class="form-control input-sm"> </div>
                                        </div>
                                         <div class="form-group">
                                            <label class="col-md-5  control-label" for="fecha_nacimiento">Fecha nac.</label>
                                            <div class="col-md-7">
                                                <div class="input-group"> <span class="input-group-addon glyphicon glyphicon-calendar"></span>
                                                    <input id="fecha_nacimiento" name="fecha_nacimiento" class="form-control input-sm" placeholder="" type="text"> </div>
                                            </div>
                                        </div>
                                         <!-- Multiple Checkboxes -->
                                        <div class="form-group">
                                            <label class="col-md-5 control-label" for="castrada">Castrada?</label>
                                            <div class="col-md-7">
                                                        <input type="checkbox" name="castrada" id="castrada" value="1">
                                                 <span class="help-block">Estado del cliente</span> </div>
                                        </div>
                                    </div>
                                        
                                        
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="col-md-3  control-label" for="especie">Especie</label>
                                            <div class="col-md-7">
                                                <select id="especie" name="especie" class="form-control input-sm">
                                                    <option value="Canino">Canino</option>
                                                    <option value="Felino">Felino</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Select Basic -->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="raza">Raza</label>
                                            <div class="col-md-7 ">
                                                <select id="raza" name="raza" class="form-control input-sm">
                                                    <option value="Pincher">Pincher</option>
                                                    <option value="Doberman">Doberman</option>
                                                    <option value="Dalmata">Dalmata</option>
                                                    <option value="Ovejero Aleman">Ovejero Aleman</option>
                                                    <option value="Caniche">Caniche</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!-- Select Basic -->
                                   
                                        <!-- Multiple Radios (inline) -->


                                       
                                   
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-3  control-label" for="chip">Chip</label>
                                            <div class="col-md-7">
                                                <input id="chip" name="chip" type="text" placeholder="" class="form-control input-sm"> </div>
                                        </div>
                                   
                                        <!-- Prepended text-->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="sexo">Sexo</label>
                                            <div class="col-md-7 ">
                                                <label class="radio-inline" for="sexo-0"> Macho </label>
                                                    <input type="radio" name="sexo" id="sexo-00" value="Macho">
                                                <label class="radio-inline" for="sexo-1"> Hembra </label>
                                                    <input type="radio" name="sexo" id="sexo-11" value="Hembra">
                                            </div>
                                        </div>
                                   
                                   
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                        <!-- Textarea -->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label" for="observaciones">Observaciones</label>
                                            <div class="col-md-10 col-md-offset-1   ">
                                                <textarea class="form-control " id="observaciones" name="observaciones" placeholder="Observaciones" rows="5"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <!-- Button (Double) -->
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="text-center">
                                                <div class="form-group">
                                                    <button id="Guardar_mascota" name="Guardar_mascota" onclick="save_mascota(); " class="btn btn-success">Guardar</button>
                                                    <button id="eliminar_mascota" name="eliminar_mascota" onclick="delete_mascota(); " class="btn btn-danger">Eliminar</button>
                                                    <button id="volver" name="volver" class="btn btn-warning" data-dismiss="modal">Cerrar</button>
                                                </div>
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
    function add_mascota(id) {
        save_method = 'add';
        //var id_cliente = id;
        $('#form_mascota')[0].reset(); // reset form on modals
        //$('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#mascota_modal').modal('show'); // show bootstrap modal
        $('.modal-title').text('Agregar mascota'); // Set Title to Bootstrap modal title
        $('.modal-body #id_cli').val(id );
    }

    function editar_mascota(id) {
        save_method = 'update';
        $('#form_mascota')[0].reset(); // reset form on modals
        //$('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        $('.modal-body #id_cli').val(id );

        $.ajax({
            url: "<?php echo site_url('mascotas/ajax_edit/')?>/" + id
            , type: "GET"
            , dataType: "JSON"
            , success: function (data) {
                //console.log(data);
                $('[name="id_mascota"]').val(data.id);
                $('[name="nombre_mascota"]').val(data.mas_nombre);
                $('[name="peso"]').val(data.mas_peso);
                $('[name="chip"]').val(data.mas_chip);
                $('[name="raza"]').val(data.mas_raza);
                $('[name="especie"]').val(data.mas_especie);
                if (data.mas_castrada == '1') {
                        $('[name="castrada"]').attr('checked', true);
                    }
                else {
                    $('[name="castrada"]').attr('checked', false);
                }
                //$('[name="cli_movil"]').val(data.cli_movil);
                $('[name="observaciones"]').val(data.mas_observaciones);

                if (data.mas_sexo === 'Macho') {
                    $('#sexo-00').prop('checked', true);
                }
                else if (data.mas_sexo === 'Hembra') {
                    $('#sexo-11').prop('checked', true);
                }



                $('[name="fecha_nacimiento"]').val(getFormattedDate(data.mas_fecha_nac));
                $('#mascota_modal').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Editar mascota'); // Set title to Bootstrap modal title
            }
            , error: function (jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }
    
    function save_mascota() {
            $('#Guardar_mascota').text('guardando...'); //change button text
            $('#Guardar_mascota').attr('disabled', true); //set button disable
            var url;

            if (save_method == 'add') {
                url = "<?php echo site_url('mascotas/ajax_add');?>";
            }
            else {
                url = "<?php echo site_url('mascotas/ajax_update_mascota');?>";
            }
            // ajax adding data to database
            $.ajax({
                url: url
                , type: "POST"
                , data: $('#form_mascota').serialize()
                , dataType: "JSON"
                , success: function (datos) {
                    if (datos.status ) //if success close modal and reload ajax table
                    {
                        $('#mascota_modal').modal('hide');
                        reload_table();
                    }
                    $('#Guardar_mascota').text('Guardar'); //change button text
                    $('#Guardar_mascota').attr('disabled', false); //set button enable
                }
                , error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error al guardar los cambios en la mascota elegida');
                    $('#Guardar_mascota').text('Guardar'); //change button text
                    $('#Guardar_mascota').attr('disabled', false); //set button enable
                }
            });
        }
    
    function delete_mascota(id) {
        var id = $('.modal-body #id_cli').val();
        if (confirm('Are you sure delete this data?' + id)) {
        // ajax delete data to database
            $.ajax({
                url: "<?php echo site_url('mascotas/ajax_delete')?>/" + id
                , type: "POST"
                , dataType: "JSON"
                , success: function (data) {
                    //if success reload ajax table
                    $('#mascota_modal').modal('hide');
                    reload_table();
                }
                , error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error deleting data');
                }
            });
            }
        }
</script>
