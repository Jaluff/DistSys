<div class="modal" id="cliente_modal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal_grande" role="document">>
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
                            
                            <form action="#" class="form-horizontal" id="cliente">
                                <div class="col-md-12">
                                    <input type="hidden" value="" name="id_cliente" id="id_cliente" />
                                    <div class="col-md-6">
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-5 control-label" for="cli_nombre">Su nombre</label>
                                            <div class="col-md-7 col-xs-12">
                                                <input id="cli_nombre" name="cli_nombre" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese su nombre y apellidos completos</span> </div>
                                        </div>
                                        <!-- Text input-->
                                        <div class="form-group">
                                            <label class="col-md-5 control-label" for="cli_documento">Documento unico</label>
                                            <div class="col-md-7 ">
                                                <input id="cli_documento" name="cli_documento" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese su documento de identidad</span> </div>
                                        </div>
                                        <!-- Select Basic -->
                                        <!-- <div class="form-group">
                                            <label class="col-md-5 control-label" for="cli_lista_precios">Lista de precios</label>
                                            <div class="col-md-7 ">
                                                <select id="cli_lista_precios" name="cli_lista_precios" class="form-control input-sm ">
                                                    <option value="1">Lista 1</option>
                                                    <option value="2">Lista 2</option>
                                                    <option value="3">Lista 3</option>
                                                </select> <span class="help-block">Seleccione una lista de precios para este cliente</span> </div>
                                        </div> -->
                                        <!-- Multiple Radios (inline) -->
                                        <div class="form-group">
                                            <label class="col-md-5 control-label" for="sexo">Sexo</label>
                                            <div class="col-md-7 ">
                                                <label class="radio-inline" for="sexo-0">  Masc. </label>
                                                    <input type="radio" name="sexo" id="sexo-0" value="Masculino"  >
                                                <label class="radio-inline" for="sexo-1"> Fem. </label>
                                                    <input type="radio" name="sexo" id="sexo-1" value="Femenino" >   <span class="help-block">Seleccione un genero </span> </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- Select Basic -->
                                        <div class="form-group">
                                            <label class="col-md-5 control-label" for="cli_tipo">Tipo de cliente</label>
                                            <div class="col-md-7 ">
                                                <select id="cli_tipo" name="cli_tipo" class="form-control input-sm">
                                                    <option value="No frecuente">No frecuente</option>
                                                    <option value="Frecuente">Frecuente</option>
                                                </select> <span class="help-block">Seleccione el tipo de cliente</span> </div>
                                        </div>
                                        <!-- Text input-->
                                        <!-- <div class="form-group">
                                            <label class="col-md-5 control-label" for="cli_fecha_nacimiento">Fecha de nacimiento</label>
                                            <div class="col-md-7 ">
                                                <input id="cli_fecha_nacimiento" name="cli_fecha_nacimiento" type="text" class="form-control input-sm  "> <span class="help-block">Ingrese su fecha de nacimiento</span> </div>
                                        </div> -->
                                        <!-- Multiple Checkboxes -->
                                        <div class="form-group">
                                            <label class="col-md-5 control-label" for="Activo">Estado</label>
                                            <div class="col-md-7 ">
                                                <div class="checkbox">
                                                    <label for="Activo"> </label>
                                                        <input type="checkbox" name="Activo" id="Activo" value="1" > Activo 
                                                </div> <span class="help-block">Estado del cliente</span> </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="col-md-12">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active"><a href="#datos_principales" aria-controls="datos_principales" role="tab" data-toggle="tab">Contacto principal</a></li>
                                    <li role="presentation"><a href="#datos_alternativos" aria-controls="datos_alternativos" role="tab" data-toggle="tab">Contacto alternativo</a></li>
                                </ul>
                                <div class="tab-content form-horizontal">
                                    <div role="tabpanel" class="tab-pane active" id="datos_principales">
                                        <div class="col-md-6">
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="direccion1">Dirección</label>
                                                <div class="col-md-7 ">
                                                    <input id="direccion1" name="direccion1" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese la calle y n°</span> </div>
                                            </div>
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="telefono1">Telefono</label>
                                                <div class="col-md-7 ">
                                                    <input id="telefono1" name="telefono1" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese el telefono fijo</span> </div>
                                            </div>
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="telefono_movil1">Telefono movil</label>
                                                <div class="col-md-7 ">
                                                    <input id="telefono_movil1" name="telefono_movil1" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese el telefono movil</span> </div>
                                            </div>
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="correo1">Correo electronico</label>
                                                <div class="col-md-7 ">
                                                    <input id="correo1" name="correo1" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese la direccino de correo electronico</span> </div>
                                            </div>
                                            <!-- Multiple Checkboxes -->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="infomail1">Info por mail?</label>
                                                <div class="col-md-7 ">
                                                    <input type="checkbox" class="checkbox" name="infomail1" id="infomail1" value="1"> <span class="help-block">El cliente desea recibir info por mail?</span> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="provincia1">Provincia</label>
                                                <div class="col-md-7 ">
                                                    <input id="provincia1" name="provincia1" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese la provincia</span> </div>
                                            </div>
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="localidad1">Localidad</label>
                                                <div class="col-md-7 ">
                                                    <input id="localidad1" name="localidad1" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese el telefono fijo</span> </div>
                                            </div>
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="pais1">Pais</label>
                                                <div class="col-md-7 ">
                                                    <input id="pais1" name="pais1" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese el pais</span> </div>
                                            </div>
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="cp1">CP</label>
                                                <div class="col-md-7 ">
                                                    <input id="cp1" name="cp1" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese el código postal</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="datos_alternativos">
                                        <div class="col-md-6">
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="direccion2">Dirección</label>
                                                <div class="col-md-7 ">
                                                    <input id="direccion2" name="direccion2" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese la calle y n°</span> </div>
                                            </div>
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="telefono2">Telefono</label>
                                                <div class="col-md-7 ">
                                                    <input id="telefono2" name="telefono2" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese el telefono fijo</span> </div>
                                            </div>
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="telefono_movil2">Telefono movil</label>
                                                <div class="col-md-7 ">
                                                    <input id="telefono_movil2" name="telefono_movil2" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese el telefono movil</span> </div>
                                            </div>
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="correo2">Correo electronico</label>
                                                <div class="col-md-7 ">
                                                    <input id="correo2" name="correo2" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese la dirección de correo electrónico</span> </div>
                                            </div>
                                            <!-- Multiple Checkboxes -->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="infomail2">Info por mail?</label>
                                                <div class="col-md-7 ">
                                                    <input type="checkbox" class="checkbox" name="infomail2" id="infomail2" value="1"> <span class="help-block">El cliente desea recibir info por mail?</span> </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="provincia2">Provincia</label>
                                                <div class="col-md-7 ">
                                                    <input id="provincia2" name="provincia2" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese la provincia</span> </div>
                                            </div>
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="localidad2">Localidad</label>
                                                <div class="col-md-7 ">
                                                    <input id="localidad2" name="localidad2" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese la localidad</span> </div>
                                            </div>
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="pais2">Pais</label>
                                                <div class="col-md-7 ">
                                                    <input id="pais2" name="pais2" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese el pais</span> </div>
                                            </div>
                                            <!-- Text input-->
                                            <div class="form-group">
                                                <label class="col-md-5 control-label" for="cp2">CP</label>
                                                <div class="col-md-7 ">
                                                    <input id="cp2" name="cp2" type="text" placeholder="" class="form-control input-sm"> <span class="help-block">Ingrese el código postal</span> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            <!-- Button (Double) -->
                            <div class="row">
                                <div class="col-md-12">
                                    <hr>
                                <div class="text-center">
                                    <div class="form-group">
                                        <button  class="btn btn-success" onclick="save_cliente(); " value="Guardar_cliente" id="Guardar_cliente">Guardar</button>
                                        <!-- <button id="Guardarymascota" name="GuardarMascota" class="btn btn-info">Guardar y agregar mascota</button> -->
                                        <button id="Cancelar" name="Cancelar" data-dismiss="modal" class="btn btn-warning">Cancelar</button>
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
        /*
         *   funciones para la gestion de clientes
         */
        function add_cliente() {
            save_method = 'add';
            $('#cliente')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#cliente_modal').modal('show'); // show bootstrap modal
            $('.modal-title').text('Nuevo cliente'); // Set Title to Bootstrap modal title
        }

        function editar_cliente(id) {
            save_method = 'update';
            $('#cliente')[0].reset(); // reset form on modals
            //$('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            //Ajax Load data from ajax
            $.ajax({
                url: "<?php echo base_url();?>cliente/ajax_edit/" + id
                , type: "GET"
                , dataType: "JSON"
                , success: function (data) {
                    $('[name="id_cliente"]').val(data.id_cliente);
                    $('[name="cli_nombre"]').val(data.cli_nombre);
                    $('[name="telefono1"]').val(data.telefono1);
                    $('[name="telefono2"]').val(data.telefono2);

                    $('[name="cli_tipo"]').val(data.cli_tipo);
                    $('[name="direccion1"]').val(data.domicilio1);
                    $('[name="direccion2"]').val(data.domicilio2);
                    $('[name="localidad1"]').val(data.localidad1);
                    $('[name="localidad2"]').val(data.localidad2);
                    $('[name="provincia1"]').val(data.provincia1);
                    $('[name="provincia2"]').val(data.provincia2);
                    $('[name="pais1"]').val(data.pais1);
                    $('[name="pais2"]').val(data.pais2);
                    $('[name="cp1"]').val(data.cp1);
                    $('[name="cp2"]').val(data.cp2);
                    $('[name="correo1"]').val(data.correo1);
                    $('[name="correo2"]').val(data.correo2);
                    $('[name="telefono_movil1"]').val(data.movil1);
                    $('[name="telefono_movil2"]').val(data.movil2);
                    $('[name="cli_documento"]').val(data.cli_doc);

                    if (data.cli_sexo === 'Masculino') {
                        $('#sexo-0').prop('checked', true);
                    }
                    else if (data.cli_sexo === 'Femenino') {
                        $('#sexo-1').prop('checked', true);
                    }
                    $('[name="cli_lista_precios"]').val(data.cli_lista_precios);

                    if (data.cli_estado == '1') {
                        $('[name="Activo"]').attr('checked', true);
                    }
                    else {
                        $('[name="Activo"]').attr('checked', false);
                    }

                    if (data.infomail1 === '1') {
                        $('#infomail1').attr('checked', true);
                    }else{
                        $('#infomail1').attr('checked', false);
                    }

                    if(data.infomail2 === '1'){
                        $('#infomail2').attr('checked', true);
                    }else{
                        $('#infomail2').attr('checked', false);
                    }

                    // $('[name="Activo"]').val(data.cli_estado);
                    $('[name="cli_fecha_nacimiento"]').val(getFormattedDate(data.cli_fecha_nac));
                    //$('[name="dob"]').datepicker('update', data.dob);
                    $('#cliente_modal').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Editar cliente'); // Set title to Bootstrap modal title
                }
                , error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error get data from ajax');
                }
            });
        }

        function save_cliente() {
            $('#Guardar_cliente').text('guardando...'); //change button text
            $('#Guardar_cliente').attr('disabled', true); //set button disable
            var url;
            if (save_method == 'add') {
                url = "<?php echo site_url('cliente/ajax_add');?>";
            }
            else {
                url = "<?php echo site_url('cliente/ajax_update');?>";
            }
            // ajax adding data to database
            $.ajax({
                url: url
                , type: "POST"
                , data: $('#cliente').serialize()
                , dataType: "JSON"
                , success: function (datos) {
                    if (datos.status) //if success close modal and reload ajax table
                    {
                        console.log('datos: ' + datos);
                        $('#cliente_modal').modal('hide');
                        //reload_table();
                        location.reload();
                    }
                    $('#Guardar_cliente').text('Guardar'); //change button text
                    $('#Guardar_cliente').attr('disabled', false); //set button enable
                }
                , error: function (jqXHR, textStatus, errorThrown) {
                    alert('Error al guardar los cambios del cliente');
                    $('#Guardar_cliente').text('Guardar'); //change button text
                    $('#Guardar_cliente').attr('disabled', false); //set button enable
                }
            });
        }

        function delete_cliente(id) {
            if (confirm('Are you sure delete this data?')) {
                // ajax delete data to database
                $.ajax({
                    url: "<?php echo site_url('cliente/ajax_delete')?>/" + id
                    , type: "POST"
                    , dataType: "JSON"
                    , success: function (data) {
                        //if success reload ajax table
                        $('#modal_form').modal('hide');
                        reload_table();
                    }
                    , error: function (jqXHR, textStatus, errorThrown) {
                        alert('Error deleting data');
                    }
                });
            }
        }
        /**
         *   Fin funciones de clientes
         */
        function getFormattedDate(d) {
            console.log(d);
            var d = new Date(d);
            d = ('0' + (d.getDate() + 1)).slice(-2) + "-" + ('0' + (d.getMonth() + 1)).slice(-2) + "-" + d.getFullYear(); //d.getHours()).slice(-2) + ":" + ('0' + d.getMinutes()).slice(-2) + ":" + ('0' + d.getSeconds()).slice(-2);
            return d;
        }
    </script>
